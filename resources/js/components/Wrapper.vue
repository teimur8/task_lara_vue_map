<template>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <center-filter
                            :items="dataToFiltering"
                            @updated="onFilter"
                    ></center-filter>
                </div>
                <div class="col-md-7">
                    <center-map
                            :items="getFilteredItems"
                    ></center-map>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-12">
                    <center-table
                            :items="getFilteredItems"
                            :fields="fields"
                    ></center-table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import CenterFilter from './Filter'
    import CenterMap from './Map'
    import CenterTable from './Table'

    export default {
        props:['items'],
        components:{
            CenterFilter,
            CenterMap,
            CenterTable
        },
        data(){
            return {
                fields: [
                    { key: 'center_name', label: 'Название', sortable: true, sortDirection: 'desc' },
                    { key: 'phone', label: 'Телефон', sortable: false },
                    { key: 'okrug', label: 'Федеральный округ', sortable: false },
                    { key: 'region.name', label: 'Регион', sortable: false },
                    { key: 'city.name', label: 'Населенный пункт', sortable: false },
                    { key: 'address.0.name', label: 'Населенный пункт', sortable: false },
                ],
                filterData: {}
            }
        },

        computed:{
            dataToFiltering(){
                let i =_(this.items);
                return {
                    okrug: i.map('okrug').uniq().value(),
                    region: i.map('region.name').uniq().value(),
                    city: i.map('city.name').uniq().value(),
                }
            },
            getFilteredItems(){

                let items = this.items;

                let search = _.get(this.filterData, 'search', "");
                let okrug = _.get(this.filterData, 'okrug', null);
                let region = _.get(this.filterData, 'region', null);
                let city = _.get(this.filterData, 'city', null);
                let big = _.get(this.filterData, 'big', false);

                if(search.length > 0) items = _.filter(items, o => o.center_name.indexOf(search) !== -1 )
                if(okrug) items = _.filter(items, {okrug} )
                if(region) items = _.filter(items, o => o.region.name === region )
                if(city) items = _.filter(items, o => o.city.name === city )
                if(big) items = _.filter(items, o => !_.isEmpty(o.big) )

                return items;

            }
        },
        methods:{
            onFilter(data){
                this.filterData = data;
            },
        }
    }
</script>

