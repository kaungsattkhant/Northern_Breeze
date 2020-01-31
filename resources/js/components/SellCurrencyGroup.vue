<template>

    <div class="col-6 currency-group-container" id="to-currency-group-container" style="position: absolute;right: -1.2%">
        <p class="border-top-radius-mount text-nb-mount mt-3 pl-3 fontsize-mount4 bg-white mb-0 pt-1 pb-2 sell-banner"
           style="width: 27%;">ပြန်လည်ပေးအပ်ငွေ</p>

        <table class="table border-0 bg-white box-shadow-mount border-tab-radius-mount currency-group-table"
               id="to-currency-group-table">
            <tbody class="rounded-table-mount ">
            <tr>
                <td class="text-center border-top-0">
                    <p class="total-text-mount pl-5 mb-1">Total MMKs :<span
                        class="total_value"></span><i>{{total_mmk}} </i></p>
                    <p class="total-text-mount pl-5 mb-1">Total :<span class="total_value"></span><i>{{total}}</i></p>
                    <p class=" total-text-mount fontsize-mount3 pl-5 mb-1">ပြန်အမ်းငွေ : {{changes}} MMKs</p>
                    <span class="text-danger mb-1 d-block">{{exceed_msg}}</span>
                    <span class="text-danger mb-1 d-block">{{sell_not_enough_msg}}</span>
                </td>
            </tr>
            <tr v-for="(group,i) in data.groups">
                <h5 class="pt-3 text-center mb-0">{{group.group_name}}</h5>

                <td class="text-nb-mount border-top-0 pl-4 pt-3 fontsize-mount2 justify-content-end pb-0" style="display: flex">
                    <div style="width: 90%;float: right;text-align: center">
<!--                        <span v-if="group.currency_value" class="fontsize-mount3 w-25 float-right">({{group.currency_value.value}}MMK)</span>-->
                        <span v-if="!isMM" class="fontsize-mount3 w-25 float-right" v-for="value in group.class_currency_value">({{value.value}}MMK)</span>
                    </div>
                </td>
<!--                <td class="text-nb-mount border-top-0 pl-4 pt-3 fontsize-mount2 justify-content-end pb-0" style="display: flex">-->
<!--                    <div style="width: 88.6%;">-->
<!--                        <input v-if="!data.class" type="number"-->
<!--                               class="from_note_class border w-25 float-right rounded-table-mount text-center fontsize-mount3 pt-1 mb-1">-->
<!--                        <input v-if="data.class" type="number" v-for="(item,k) in group.class_currency_value"-->
<!--                               class="border rounded-table-mount  w-25 float-left text-center font-color fontsize-mount3 pt-1 mb-1">-->
<!--                    </div>-->
<!--                </td>-->
                <td class="text-nb-mount border-top-0 pl-4 pt-2 fontsize-mount2 justify-content-between"
                    style="display: flex"
                    v-for="(note,j) in group.notes">
                    <span class="fontsize-mount22 span-number">{{note.note_name}}</span>

                    <div class="input-group-box">
                        <div class="w-25 float-right">

                            <input v-if="isMM" type="number" min="0"
                                   v-model="sheets[i][j]"
                                   v-on:keyup="calculateTotalAndChanges(note,sheets[i][j])"
                                   v-on:change="calculateTotalAndChanges(note,sheets[i][j])"
                                   class="from_note_class border  rounded-table-mount w-100 text-center fontsize-mount3 pt-1 ">
                        </div>



                        <div class="w-25 float-left"
                             v-for="(item,k) in note.class_sheet">

                            <input v-if="!isMM" type="number" min="0"
                                   v-model="sheets[i][j][k]"
                                   v-on:keyup="calculateTotalAndChanges(item,sheets[i][j][k])"
                                   v-on:change="calculateTotalAndChanges(item,sheets[i][j][k])"
                                   class="border rounded-table-mount w-100  text-center font-color fontsize-mount3 pt-1 ">

                        </div>

                    </div>
                </td>
            </tr>

<!--                    tr for space-->
            <tr>
                <td class="text-nb-mount border-top-0 pl-4 pt-3 justify-content-between fontsize-mount2">

                </td>
            </tr>


            </tbody>


        </table>

    </div>


</template>

<script>
    import Vuex, {mapState} from 'vuex'
    import Vue from 'vue';
    import {helpers} from '../helpers.js'


    Vue.use(Vuex);

    export default {
        props: ['data','isMM'],
        data() {
            return {
                sheets: [],
                current_value_mmk: [],
                current_value: [],
                groups_length: this.data.groups.length,
                notes_length: 10, //maximum possible number of notes in a group
                classes_length: 10,//maximum possible number of classes in a note
                total_mmk: 0,
                total: 0,
                class_string: 'Class ',
                type: 'sell'

            }
        },

        methods: {
            setInitialGroups: helpers.setInitialGroups,
            refreshGroup: helpers.updateInitialGroups,
            setInitialSheets: helpers.setInitialSheet,
            calculateTotalMMK: helpers.calculateTotalMMK,
            calculateTotal: helpers.calculateTotal,

            isClass() {
                return !!this.data.class;
            },

            resetStore() {
                this.$store.commit('setOutValues', [this.total, this.total_mmk]);
                this.$store.commit('isExceed', [this.in_value_MMK, this.out_value_MMK]);
                this.$store.commit('setSellStatus', this.data.status);
                this.$store.commit('setStatus', [this.sell_status, this.buy_status]);
                this.$store.commit('setTransaction', [this.in_value, this.in_value_MMK, this.out_value, this.out_value_MMK, this.status, this.changes]);
                this.$store.commit('setResults', [this.transaction, this.getGroups]);
            },

            calculateTotalAndChanges(item,input_sheet) {
                let total_sheet;
                if(this.isMM){
                    total_sheet = item.total_sheet;
                }else{
                    total_sheet = item.sheet;
                }

                if(input_sheet>=0 && input_sheet<=total_sheet){
                    this.$store.commit('setSellNotEnoughMsg', '');
                    this.refreshGroup(this.type,this.getGroups,this.sheets,this.isMM);
                    this.total_mmk = parseFloat(this.calculateTotalMMK(this.type,this.getGroups,this.isMM).toFixed(2)) ;
                    this.total = this.calculateTotal(this.type,this.getGroups,this.isMM);
                    this.$store.commit('setOutValues', [this.total, this.total_mmk]);
                    this.$store.commit('isExceed', [this.in_value_MMK, this.out_value_MMK]);
                    this.$store.commit('setSellStatus', this.data.status);
                    this.$store.commit('setStatus', [this.sell_status, this.buy_status]);
                    this.$store.commit('setTransaction', [this.in_value, this.in_value_MMK, this.out_value, this.out_value_MMK, this.status,this.changes]);
                    this.$store.commit('setResults', [this.transaction, this.getGroups]);
                }else{
                    this.$store.commit('setSellNotEnoughMsg', 'Invalid Value!');
                }
            }
        },
        mounted() {
            this.setInitialGroups(this.type, this.data.groups, this.isMM);
            this.resetStore();
        },
        created() {
            let lengths = {
                groups: this.groups_length,
                notes: this.notes_length,
                classes: this.classes_length
            };
            this.setInitialSheets(this.sheets, lengths, this.isMM);

        },
        computed: mapState({
            getGroups: 'groups',
            getResults: 'results',
            buyTotal: 'buy_total_mmk',
            sellTotal: 'sell_total_mmk',
            in_value: 'in_value',
            in_value_MMK: 'in_value_MMK',
            out_value: 'out_value',
            out_value_MMK: 'out_value_MMK',
            transaction: 'transaction',
            buy_status: 'buy_status',
            sell_status: 'sell_status',
            sell_not_enough_msg: 'sell_not_enough_msg',
            status: 'status',
            exceed_msg: 'exceed_msg',
            changes: 'changes'
        }),

    }

</script>
