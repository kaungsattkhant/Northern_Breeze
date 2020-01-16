<template>

    <div class="container-nb-mount">

        <form >
            <div class="d-flex justify-content-between top-box-mount shadow-sm">
                <div class="my-auto ">
                    <select class="selectpicker ml-4 show-menu-arrow buy_currency_option" name="from_currency"
                            v-on:change="fetch_currency_groups('buy')" data-style="btn-white" data-width="auto">
                        <option selected disabled>လဲလှယ်မည့်ငွေ</option>
                        <option :value="item.id" v-for="item in items">{{item.name}}</option>

                    </select>

                    <select class="selectpicker pl-4 show-menu-arrow sell_currency_option" name="to_currency"
                            v-on:change="fetch_currency_groups('sell')" data-style="btn-white" data-width="auto">
                        <option selected disabled>ပြန်လည်ထုတ် ပေးမည့်ငွေ</option>
                        <option :value="item.id" v-for="item in items">{{item.name}}</option>

                    </select>

                </div>
                <button type="button" v-on:click="submitForm()" class="btn btn-nb-mount-save fontsize-mount">သိမ်းမည်</button>
            </div>
            <div class="row">
                <div class="col currency-group-container" id="from-currency-group-container" >
                    <p class="border-top-radius-mount text-nb-mount mt-3 pl-3 fontsize-mount4 bg-white mb-0 pt-1 pb-2 w-25 ">
                        လဲလှယ်မည့်ငွေ</p>
                    <table class="table border-0 bg-white box-shadow-mount border-tab-radius-mount currency-group-table" id="from-currency-group-table" >

                        <buy-currency-group v-if="buy_currency_groups" :data="buy_currency_groups"></buy-currency-group>
                        <buy-us-currency-group v-if="us_buy_currency_groups" :data="us_buy_currency_groups"></buy-us-currency-group>

                    </table>
                </div>
                <div class="col currency-group-container" id="to-currency-group-container">
                    <p class="border-top-radius-mount text-nb-mount mt-3 pl-3 fontsize-mount4 bg-white mb-0 pt-1 pb-2"
                       style="width: 27%">ပြန်လည်ပေးအပ်ငွေ</p>

                    <table class="table border-0 bg-white box-shadow-mount border-tab-radius-mount currency-group-table" id="to-currency-group-table" >


                        <sell-currency-group v-if="sell_currency_groups" :data="sell_currency_groups"></sell-currency-group>
                        <sell-us-currency-group v-if="us_sell_currency_groups" :data="us_sell_currency_groups"></sell-us-currency-group>

                    </table>

                </div>
            </div>
        </form>
    </div>


</template>


<script>
    import Vuex from 'vuex'
    Vue.use(Vuex);
    import Vue from 'vue';
    export default {
        props: ['currencies'],
        data() {
            return {
                items: JSON.parse(this.currencies),
                sell_currency_groups: '',
                us_sell_currency_groups: '',
                buy_currency_groups: '',
                us_buy_currency_groups: '',
            }
        },

        methods: {

            submitForm(){
// <<<<<<< HEAD
//                 let data={};
//                if($.isEmptyObject(this.getResults)){
//                     data.data=this.getClassGroups;
//
//                }else{
//                    data.data=this.getResults;
//                }
//                 fetch('/pos/transaction', {
// =======
                let data= {...this.getResults};
                console.log(JSON.stringify(this.getResults));
                fetch('/pos/transaction', {
// >>>>>>> origin/medium
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify(this.getResults)
                })
                    .then(response=>response.json())
                    .then(data =>{
                            console.log(data);
                })


            },

            fetch_currency_groups(status) {


                let type;
                let currency_id;

                if(status==='buy'){
                    type='buy';
                    this.buy_currency_groups = '';
                    this.us_buy_currency_groups = '';
                }else{
                    type='sell';
                    this.sell_currency_groups = '';
                    this.us_sell_currency_groups = '';

                }
                currency_id = parseInt($('.'+type+'_currency_option option:selected').val());

                let data = {
                    currency_id: currency_id ,
                    status: status,
                    is_member: true,
                };
                fetch('/pos/currency_group', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify(data)
                })
                    .then(response => response.json())
                    .then(data => {

                        if(status==='buy'){

                            if(data.groups[0].class_currency_value){
                                this.us_buy_currency_groups = data;
                            }else{
                                this.buy_currency_groups = data;
                            }
                        }else{
                            if(data.groups[0].class_currency_value){
                                this.us_sell_currency_groups = data;
                            }else{
                                this.sell_currency_groups = data;
                            }
                            // console.log(this.sell_currency_groups)
                        }


                    });
            }
        },
        mounted() {
        },
        computed: {
            getResults(){
                return this.$store.state.results;
            },


        },
    }

</script>
