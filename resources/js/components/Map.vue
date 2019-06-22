<template>
    <div>
        <GmapMap
                :center="center"
                :zoom="zoom"
                map-type-id="terrain"
                style="width: 100%; height: 400px"
        >
            <GmapInfoWindow :options="infoOptions" :position="infoWindowPos" :opened="infoWinOpen" @closeclick="infoWinOpen=false">
                <div style="word-break: break-word; width: 300px; line-height: 1.4">
                    <b style="font-weight: bold;"><a :href="'/center/' + infoContent.id" target="_blank">{{ infoContent.name }}</a></b>
                    <br>{{ infoContent.okrug }}<br>
                    {{ infoContent.region}}<br>
                    {{ infoContent.address}}<br>
                    {{ infoContent.phone}}
                </div>
            </GmapInfoWindow>

            <GmapMarker
                    :key="index"
                    v-for="(m, index) in mapPoints"
                    :position="m.position"
                    :clickable="true"
                    @click="click(m, index)"
            />
        </GmapMap>
    </div>
</template>

<script>
    export default {
        props:{
            items:{
                type: Array,
                default:[],
            },
            zoom:{
                type: Number,
                default: 3
            }
        },
        data(){
            return {
                center:{lat:56.323678, lng:44},

                currentMidx: null,
                infoContent: {},
                infoWindowPos: null,
                infoWinOpen: false,
                infoOptions: {
                    pixelOffset: {
                        width: 0,
                        height: -35
                    }
                },
            }
        },
        computed:{
            mapPoints(){
                return _.map(this.items, (item)=>{
                    return {
                        position:{
                            lat: parseFloat(_.get(item, 'map.0.latitude', 0)),
                            lng: parseFloat(_.get(item, 'map.0.longitude', 0))
                        },
                        id: item.id,
                        name: _.get(item, 'center_name'),
                        okrug: _.get(item, 'okrug'),
                        region: _.get(item, 'region.name'),
                        address: _.get(item, 'address.0.name'),
                        phone: _.get(item, 'phone'),
                    }
                })
            }
        },
        methods:{
            click(m, index){
                this.center = m.position;

                this.infoWindowPos = m.position;
                this.infoContent = m;

                if (this.currentMidx == index) {
                    this.infoWinOpen = !this.infoWinOpen;
                }else {
                    this.infoWinOpen = true;
                    this.currentMidx = index;
                }

            }
        }

    }
</script>

