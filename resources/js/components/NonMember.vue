<template>

    <div class="container-nb-mount">

        <form>
            <div class="d-flex justify-content-between top-box-mount shadow-sm">
                <div class="my-auto fs-select6">
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

                <div class="my-auto">



                <button type="button" v-bind:class="{'disable': isSaveDisable()}" id="save-btn"
                            :disabled="isSaveDisable()"
                            v-on:click="submitForm()" class="btn btn-nb-mount-save fontsize-mount font-weight-bold">
                        သိမ်းမည်
                    </button>
                </div>
            </div>
            <div class="row">
                <buy-currency-group v-if="buy_currency_groups" :data="buy_currency_groups" :isMM="isMMForBuy()"></buy-currency-group>
                <sell-currency-group v-if="sell_currency_groups" :data="sell_currency_groups" :isMM="isMMForSell()"></sell-currency-group>
            </div>
        </form>
    </div>


</template>


<script>
    import Vuex, {mapState} from 'vuex'
    import Vue from 'vue';

    Vue.use(Vuex);
    export default {
        props: ['currencies','is_admin'],
        data() {
            return {
                items: JSON.parse(this.currencies),
                sell_currency_groups: '',
                buy_currency_groups: '',
                current_currency: '',
            }
        },

        methods: {
            isSaveDisable() {
                return !!(this.exceed_msg || this.buy_not_enough_msg || this.sell_not_enough_msg || !this.in_value_MMK || !this.out_value_MMK);
            },
            isMMForBuy(){
                return this.buy_currency_groups.status === "MMK";
            },

            isMMForSell(){
                return this.sell_currency_groups.status === "MMK";
            },

            submitForm() {

                console.log(this.getResults);
                // $('#save-btn').append(`
                //     <i class="fa fa-spinner fa-spin"></i>
                // `).prop('disabled',true);
                // fetch('/pos/transaction', {
                //     method: 'POST',
                //     headers: {
                //         'Content-Type': 'application/json',
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     },
                //     body: JSON.stringify(this.getResults)
                // })
                //     .then(response => response.json())
                //     .then(data => {
                //         if(data.is_success){
                //             window.location.replace('/sale');
                //         }else{
                //             $("#save-btn").children("i:first").remove();
                //             $('#save-btn').prop('disabled',false);
                //             // window.location.replace('/pos/non_member');
                //         }
                //     })
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
