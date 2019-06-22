<template>
    <div>
        <div class="form-group">
            <label>Быстрый поиск</label>
            <input type="text" class="form-control" v-model="filter.search">
        </div>
        <div class="form-group">
            <label>Округ</label>
            <b-form-select v-model="filter.okrug" :options="items.okrug">
                <option :value="null">Все</option>
            </b-form-select>
        </div>
        <div class="form-group">
            <label>Регион</label>
            <b-form-select v-model="filter.region" :options="items.region">
                <option :value="null">Все</option>
            </b-form-select>
        </div>
        <div class="form-group">
            <label>Город</label>
            <b-form-select v-model="filter.city" :options="items.city">
                <option :value="null">Все</option>
            </b-form-select>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" id="big" class="form-check-input" v-model="filter.big">
            <label class="form-check-label" for="big">Крупные амбулаторные центры – от 50 мест</label>
        </div>
    </div>
</template>

<script>
    export default {
        props:['items'],
        data(){
            return {
                filter:{
                    search:'',
                    okrug:null,
                    region:null,
                    city: null,
                    bit: false,
                }
            }
        },
        methods:{
          updated(){
              this.$emit("updated", this.filter)
          }
        },
        watch:{
            filter:{
                handler: function (val, oldVal) {
                    this.updated();
                },
                deep: true
            }
        }
    }
</script>

