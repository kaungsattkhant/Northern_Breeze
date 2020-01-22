<template>

    <div class="col currency-group-container" id="from-currency-group-container"  >
        <p class="border-top-radius-mount text-nb-mount mt-3 pl-3 fontsize-mount4 bg-white mb-0 pt-1 pb-2 w-25 buy-banner">
            လဲလှယ်မည့်ငွေ</p>
        <table class="table border-0 bg-white box-shadow-mount border-tab-radius-mount currency-group-table"
               id="from-currency-group-table">
            <tbody class="rounded-table-mount ">
            <tr>
                <td class="border-top-0 text-nb-mount d-none" style="padding: 30px;"></td>
                <td class="text-center border-top-0">
                    <p class="total-text-mount pl-5 mb-1">Total MMKs :<span
                        class="total_value"></span><i>{{total_mmk}} </i></p>
                    <p class="total-text-mount pl-5 mb-1">Total :<span class="total_value"></span><i>{{total}}</i></p>
                    <span class="text-danger">{{buy_not_enough_msg}}</span>
                </td>
            </tr>
            <tr v-for="(group,i) in data.groups">
                <h5 class="pt-3 text-center mb-0">{{group.group_name}}</h5>
                <td class="text-nb-mount border-top-0 pl-4 pt-3 fontsize-mount2 justify-content-between"
                    style="display: flex"
                    v-for="(note,j) in group.notes">
                    <span class="fontsize-mount22 span-number">{{note.note_name}}</span>
                    <div class="input-group-box">
                        <input v-if="!data.class" type="number" min="0" v-model="sheets[i][j]"
                               v-on:keyup="calculateTotalAndChanges(group,note,i,j)"
                               v-on:change="calculateTotalAndChanges(group,note,i,j)"
                               class="from_note_class border float-right rounded-table-mount w-25 text-center fontsize-mount3 pt-1"
                               placeholder=""
                               onchange="">

                        <input v-if="data.class" type="number" min="0" v-model="sheets[i][j][k]"
                               v-for="(item,k) in group.class_currency_value"
                               placeholder="Class "
                               v-on:keyup="calculateTotalAndChanges(group,note,i,j,k,item.value)"
                               v-on:change="calculateTotalAndChanges(group,note,i,j,k,item.value)"
                               class="border rounded-table-mount float-right w-25 text-center font-color fontsize-mount3 pt-1 ">

                    </div>
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
        props: ['data'],
        data() {
            return {
                sheets: [],
                current_value_mmk: [],
                current_value: [],
                groups: this.data.groups.length,
                notes: 10, //maximum possible number of notes in a group
                classes: 10,//maximum possible number of classes in a note
                total_mmk: 0,
                total: 0,
            }
        },

        methods: {
            setInitialGroups: helpers.setInitialGroups,
            sum: helpers.sumOfAllContentsOfArray,
            refreshGroup: helpers.removeOldElementAndAddNew,
            setInitialSheets: helpers.setInitialSheets,

            isClass() {
                return !!this.data.class;
            },

            resetStore() {
                this.$store.commit('setInValues', [this.total, this.total_mmk]);
                this.$store.commit('isExceed', [this.in_value_MMK, this.out_value_MMK]);
                this.$store.commit('setBuyStatus', this.data.status);
                this.$store.commit('setStatus', [this.sell_status, this.buy_status]);
                this.$store.commit('setTransaction', [this.in_value, this.in_value_MMK, this.out_value, this.out_value_MMK, this.status]);
                this.$store.commit('setResults', [this.transaction, this.getGroups]);
            },

            currency_value(group) {
                if (group.currency_value) {
                    return group.currency_value.value;
                }
                return 1;
            },

            calculateTotalAndChanges(group, note, i, j, k = null, class_value = null) {
                let sheets;
                if (this.isClass()) {
                    sheets = this.sheets[i][j][k];
                } else {
                    sheets = this.sheets[i][j];
                }
                if (sheets >= 0) {
                    this.$store.commit('setBuyNotEnoughMsg', '');
                    if (this.isClass()) {
                        this.current_value_mmk[i][j][k] = class_value * note.note_name * sheets;
                        this.current_value[i][j][k] = note.note_name * sheets;
                        this.refreshGroup('buy', this.getGroups, sheets, group, note, k);

                    } else {
                        this.current_value_mmk[i][j] = this.currency_value(group) * note.note_name * sheets;
                        this.current_value[i][j] = note.note_name * sheets;
                        this.refreshGroup('buy', this.getGroups, sheets, group, note);

                    }
                    this.total = this.sum(this.current_value);
                    this.total_mmk = this.sum(this.current_value_mmk);
                    this.$store.commit('setInValues', [this.total, this.total_mmk]);
                    this.$store.commit('isExceed', [this.in_value_MMK, this.out_value_MMK]);
                    this.$store.commit('setBuyStatus', this.data.status);
                    this.$store.commit('setStatus', [this.sell_status, this.buy_status]);
                    this.$store.commit('setTransaction', [this.in_value, this.in_value_MMK, this.out_value, this.out_value_MMK, this.status]);
                    this.$store.commit('setResults', [this.transaction, this.getGroups]);
                } else {
                    this.$store.commit('setBuyNotEnoughMsg', 'Invalid Value!');
                }
            }
        },
        mounted() {
            this.setInitialGroups('buy', this.data, this.isClass());
            this.resetStore();
            this.current_value_mmk = JSON.parse(JSON.stringify(this.sheets));
            this.current_value = JSON.parse(JSON.stringify(this.sheets));
        },
        created() {
            let lengths;
            if (this.isClass()) {
                lengths = {
                    groups: this.groups,
                    notes: this.notes,
                    classes: this.classes
                }
            } else {
                lengths = {
                    groups: this.groups,
                    notes: this.notes
                }
            }
            this.setInitialSheets(lengths, this.sheets, this.isClass())
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
            buy_not_enough_msg: 'buy_not_enough_msg',
            status: 'status',
        }),

    }

</script>
