<template>

    <div id="group" class="">

<!--        <div class="row pl-1 pt-5">-->
<!--            <div class="col-4">-->
<!--                <label class="pl-3 text-color-mount fontsize-mount pr-4 my-auto">Group Name</label>-->
<!--            </div>-->
<!--            <div class="col ">-->
<!--                <div class="row mx-0">-->
<!--                    <div v-for="group in data.groups" class="col mx-0 pr-3 col-item ">-->
<!--                        <p class="text-color-mount fontsize-mount17 pt-1">{{group.name}}</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <div class="row pl-1 pt-5">
            <div class="col-4">
                <label class="pl-3 text-color-mount fontsize-mount6 pr-4 my-auto">Group Name</label>
            </div>
            <div class="col pl-0">
                <div  class="col row mx-0 px-0">
                    <div v-for="group in data.groups" class="col px-0 mx-2 col-item ">
                        <p class="text-color-mount fontsize-mount17 pt-0">{{group.name}}</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mb-4 pl-1">
            <div class="col-4">
            </div>
            <div v-for="group in data.groups" class="col">
                <p class="text-color-mount fontsize-mount2 pt-1 text-center for-quote">
                    <span v-for="note in group.notes">
                        {{note.name}},
                    </span>
                </p>
            </div>
        </div>

        <div class="row pt-3  pl-1">
            <div class="col-4">
                <label class="pl-3 text-color-mount fontsize-mount6 pr-4 my-auto">Selling Value</label>
            </div>
            <div v-for="(group,i) in data.groups" class="col pl-0">
                <div v-if="isUs" class="col px-2">
                    <div v-for="(item,j) in data.class" class="col-item-mini text-color-mount fontsize-mount2 for-input-pl">
                        <input
                                v-on:change="handleValue('sell',group,sell_value[i][j],item.id)"
                                v-on:keyup="handleValue('sell',group,sell_value[i][j],item.id)"
                                v-model="sell_value[i][j]"
                                type="number" min="0"
                               :placeholder="item.name"
                               class="pl-3 text-center" style="width: 100%;border: none;background-color: transparent">
                    </div>
                </div>
                <div v-if="!isUs" class="col px-2 ">
                    <div class="col-item-mini text-color-mount fontsize-mount2 for-input-pl">
                        <input
                            v-on:change="handleValue('sell',group,sell_value[i],1)"
                            v-on:keyup="handleValue('sell',group,sell_value[i],1)"
                            v-model="sell_value[i]"
                            type="number" min="0" :placeholder="group.name" class="text-center text-box-mount">
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3 pl-1">
            <div class="col-4">
            </div>
        </div>

        <div class="row mb-1 pl-1 pt-3 pb-5">
            <div class="col-4">
                <label class="pl-3 text-color-mount fontsize-mount6 pr-4 my-auto">Buying Value</label>
            </div>
            <div v-for="(group,i) in data.groups" class="col pl-0">
                <div v-if="isUs" class="col px-2">
                    <div v-for="(item,j) in data.class" class="col-item-mini text-color-mount fontsize-mount2 for-input-pl">
                        <input
                                v-on:change="handleValue('buy',group,buy_value[i][j],item.id)"
                                v-on:keyup="handleValue('buy',group,buy_value[i][j],item.id)"
                                v-model="buy_value[i][j]"
                                type="number" min="0" :placeholder="item.name"
                               class="pl-3 text-center" style="width: 100%;border: none;background-color: transparent">
                    </div>
                </div>
                <div v-if="!isUs" class="col px-2 ">
                    <div class="col-item-mini text-color-mount fontsize-mount2 for-input-pl">
                        <input
                            v-on:change="handleValue('buy',group,buy_value[i],1)"
                            v-on:keyup="handleValue('buy',group,buy_value[i],1)"
                            v-model="buy_value[i]"
                            type="number" min="0" :placeholder="group.name" class="text-center text-box-mount">
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3 pl-1">
            <div class="col-4">
            </div>
        </div>
    </div>

</template>

<script>
    import Vuex, {mapState} from 'vuex'
    import Vue from 'vue';
    Vue.use(Vuex);

    export default {
        props: ['data', 'isUs','currency_id'],
        data() {
            return {
                sell_value: [],
                buy_value: [],
                groups: [],
                final_data: {},
            }
        },

        methods: {
            setInitialData(){
                let _this = this;
                this.groups = JSON.parse(JSON.stringify(this.data.groups));
                let class_value = [
                    {
                        "class_id":1,
                        "value":0
                    },
                    {
                        "class_id":2,
                        "value":0
                    },

                    {
                        "class_id":3,
                        "value":0
                    },
                    {
                        "class_id":4,
                        "value":0
                    }
                ];
                this.groups.forEach(function (groupItem) {
                    groupItem.class_group_value = JSON.parse(JSON.stringify(class_value));
                    groupItem.type='sell';
                    delete groupItem['name'];
                    delete groupItem['notes'];
                    let newItem = JSON.parse(JSON.stringify(groupItem));
                    newItem.class_group_value = JSON.parse(JSON.stringify(class_value));
                    newItem.type='buy';
                    _this.groups.push(newItem)
                });
                this.final_data.currency_id = this.currency_id;
                this.final_data.daily_value = this.groups;
            },

            handleValue(type,group,value,class_id){
                let targetGroup = this.groups.find(function (groupItem) {
                    return groupItem.group_id === group.group_id && groupItem.type === type;
                });
                let targetClass= targetGroup.class_group_value.find(function (classItem) {
                    return classItem.class_id === class_id;
                });
                targetClass.value = value;
                this.$store.commit('setDailyCurrencyData', this.final_data);
                console.log(this.final_data)
            }
        },

        mounted() {
            this.setInitialData();
        },

        created(){
            if(this.isUs){
                for (let i = 0; i < this.data.groups.length; i++) {
                    let row = [];
                    for (let j = 0; j < this.data.class.length; j++) {
                        row.push(0);
                    }
                    this.sell_value.push(row);
                }
            }else{
                for(let i=0; i<this.data.groups.length; i++){
                    this.sell_value.push(0);
                }
            }
            this.buy_value = JSON.parse(JSON.stringify(this.sell_value));
        },
        computed: mapState({
            daily_currency_data: 'daily_currency_data'
        }),

    }

</script>
