<template>
    <div class="container-nb-mount">
        <div>
            <table class="table bg-white border-bottom-radius-mount mb-4">
                <thead>
                <tr>
                    <td>
                        <input type="text" v-model="search_member" v-on:keyup="searchMember" class="form-control col-md-4">
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6 pl-4" >Name</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6 text-center">Member Role</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6 text-right pr-5">Point</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="m in member">
                    <td scope="row" class="table-row-m fontsize-mount2 border-top-0 pl-4 text-color-mount">{{m.name}}</td>
                    <td class="table-row-m fontsize-mount2 border-top-0 text-center text-color-mount">{{m.member_type.name}}</td>
                    <td class="table-row-m fontsize-mount2 border-top-0 text-right pr-5 text-color-mount">10000</td>

                </tr>
                </tbody>
            </table>
        </div>
        <form>

            <div>
                <div class="d-flex justify-content-between  top-box-mount shadow-sm border-top-radius-mount">
                    <div class="my-auto fs-select2">

                        <select class="selectpicker ml-4 show-menu-arrow buy_currency_option" name="from_currency"
                                v-on:change="fetch_currency_groups('buy')" data-style="btn-white" data-width="auto">
                            <option selected disabled>လဲလှယ်မည့်ငွေ</option>
                            <option :value="item.id"
                                    v-bind:disabled="item.id === current_currency"
                                    v-for="item in items">{{item.name}}
                            </option>

                        </select>

                        <select class="selectpicker pl-4 show-menu-arrow sell_currency_option" name="to_currency"
                                v-on:change="fetch_currency_groups('sell')" data-style="btn-white" data-width="auto">
                            <option selected disabled>ပြန်လည်ထုတ်ပေးမည့်ငွေ</option>
                            <option :value="item.id"
                                    v-bind:disabled="item.id === current_currency"
                                    v-for="item in items">{{item.name}}
                            </option>
                        </select>

                    </div>
                    <button type="button" v-bind:class="{'disable': isSaveDisable()}"
                            :disabled="isSaveDisable()"
                            v-on:click="submitForm()" class="btn btn-nb-mount-save fontsize-mount font-weight-bold">
                        သိမ်းမည်
                    </button>
                </div>
            </div>

            <div class="row " style="min-height: 120vh;height: max-content;display: block">
                <member-buy-currency-group style="float: left" v-if="buy_currency_groups" :data="buy_currency_groups" :isMM="isMMForBuy()"></member-buy-currency-group>
                <member-sell-currency-group style="float: right" v-if="sell_currency_groups" :data="sell_currency_groups" :isMM="isMMForSell()"></member-sell-currency-group>

            </div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    import Vuex, {mapState} from 'vuex'
    import Vue from 'vue';

    Vue.use(Vuex);
    export default {
        props: ['currencies'],
        data() {
            return {
                items: JSON.parse(this.currencies),
                sell_currency_groups: '',
                buy_currency_groups: '',
                current_currency: '',
                search_member:'',
                member:[],
            }
        },

        methods: {
            isSaveDisable() {
                return !!(this.exceed_msg || this.buy_not_enough_msg || this.sell_not_enough_msg || !this.in_value_MMK || !this.out_value_MMK);
            },
            submitForm() {
                fetch('/transaction', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify(this.getResults)
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                    })
            },
            isMMForBuy(){
                return this.buy_currency_groups.status === "MMK";
            },

            isMMForSell(){
                return this.sell_currency_groups.status === "MMK";
            },

            fetch_currency_groups(status) {
                let type;
                let currency_id;
                if (status === 'buy') {
                    type = 'buy';
                    this.buy_currency_groups = '';
                } else {
                    type = 'sell';
                    this.sell_currency_groups = '';
                }
                currency_id = parseInt($('.' + type + '_currency_option option:selected').val());

                this.current_currency = currency_id;

                let data = {
                    currency_id: currency_id,
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
                        if (status === 'buy') {
                            this.buy_currency_groups = data;
                        } else {
                            this.sell_currency_groups = data;
                        }
                        $('.selectpicker').selectpicker('refresh');

                    });
            },
            searchMember(){
                var vm=this;
                // console.log(vm.search_member);
                axios.get('/pos/get_member',{
                    params:{
                        search:vm.search_member,
                    }
                }).then(function (response) {
                    // console.log(response);
                    vm.member=response.data;
                    // console.log(response.data);
                });
            }
        },

        mounted() {

        },
        computed: mapState({
            getResults: 'results',
            sell_not_enough_msg: 'sell_not_enough_msg',
            buy_not_enough_msg: 'buy_not_enough_msg',
            in_value_MMK: 'in_value_MMK',
            out_value_MMK: 'out_value_MMK',
            status: 'status',
            exceed_msg: 'exceed_msg',
        }),
    }

</script>
