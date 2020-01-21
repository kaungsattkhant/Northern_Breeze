<template>

    <tbody class="rounded-table-mount ">
    <tr>
        <td class="border-top-0 text-nb-mount d-none" style="padding: 30px;"></td>
        <td class="text-center border-top-0">
            <p class="total-text-mount pl-5 mb-1">Total MMKs :<span class="total_value"></span><i>{{total_mmk}} </i></p>
            <p class="total-text-mount pl-5 mb-1">Total :<span class="total_value"></span><i>{{total}}</i></p>
            <span class="text-danger">{{buy_not_enough_msg}}</span>
        </td>
    </tr>
    <tr v-for="(group,i) in data.groups">
        <h5 class="pt-3 text-center mb-0">{{group.group_name}}</h5>
        <td class="text-nb-mount border-top-0 pl-4 pt-3 fontsize-mount2 justify-content-between" style="display: flex"
            v-for="(note,j) in group.notes">
            <span class="fontsize-mount22 span-number">{{note.note_name}}</span>
            <div class="input-group-box">
                <input type="number" min="0" v-model="sheets[i][j]"
                       v-on:keyup="calculateTotalAndChanges(group,note,i,j)"
                       v-on:change="calculateTotalAndChanges(group,note,i,j)"
                       class="from_note_class border float-right rounded-table-mount w-25 text-center fontsize-mount3 pt-1"
                       placeholder=""
                       onchange="">
            </div>
        </td>
    </tr>


    </tbody>


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
                total_mmk: 0,
                total: 0,
            }
        },

        methods: {
            setInitialGroups: helpers.setInitialGroups,
            sum: helpers.sumOfAllContentsOfArray,
            refreshGroup: helpers.removeOldElementAndAddNew,
            setInitialSheets: helpers.setInitialSheets,

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

            calculateTotalAndChanges(group, note, i, j) {
                if (this.sheets[i][j] >= 0) {
                    this.$store.commit('setBuyNotEnoughMsg', '');
                    this.current_value_mmk[i][j] = this.currency_value(group) * note.note_name * this.sheets[i][j];
                    this.current_value[i][j] = note.note_name * this.sheets[i][j];
                    this.total = this.sum(this.current_value);
                    this.total_mmk = this.sum(this.current_value_mmk);
                    this.refreshGroup('buy', this.getGroups, this.sheets[i][j], group, note);
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
            this.setInitialGroups('buy', this.data, false);
            this.resetStore();
            this.current_value_mmk = JSON.parse(JSON.stringify(this.sheets));
            this.current_value = JSON.parse(JSON.stringify(this.sheets));
        },
        created() {
            let lengths = {
                groups: this.groups,
                notes: this.notes
            };
            this.setInitialSheets(lengths, this.sheets, false)
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
