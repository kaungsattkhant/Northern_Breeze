<template>

    <tbody class="rounded-table-mount ">
    <tr>
        <td class="text-center border-top-0">
            <p class="total-text-mount pl-5 ">Total MMKs :<span class="total_value"></span><i>{{total_mmk}} </i></p>
            <p class="total-text-mount pl-5 ">Total :<span class="total_value"></span><i>{{total}}</i></p>
            <p class=" total-text-mount fontsize-mount3 pl-5">ပြန်အမ်းငွေ : {{changes}} MMKs</p>
            <span class="text-danger">{{exceed_msg}}</span>
            <span class="text-danger">{{sell_not_enough_msg}}</span>
        </td>
    </tr>
    <tr v-for="(group,i) in data.groups">
        <h5 class="pt-3 text-center mb-0">{{group.group_name}}</h5>
        <td class="text-nb-mount border-top-0 pl-4 pt-3 justify-content-between fontsize-mount2" style="display: flex"
            v-for="(note,j) in group.notes">
            <span class="fontsize-mount22 span-number">{{note.note_name}}</span>
            <div class="input-group-box">
                <input type="number" min="0" :max="note.class_sheet[k].sheet" v-model="sheets[i][j][k]"
                       v-for="(item,k) in group.class_currency_value"
                       placeholder="Class "
                       v-on:keyup="calculateTotalAndChanges(group,note,item.value,i,j,k)"
                       v-on:change="calculateTotalAndChanges(group,note,item.value,i,j,k)"
                       class="border rounded-table-mount float-right w-25 text-center fontsize-mount3 pt-1 ">
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
                current_value: [],
                current_value_mmk: [],
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

            resetStore() {
                this.$store.commit('setOutValues', [this.total, this.total_mmk]);
                this.$store.commit('isExceed', [this.in_value_MMK, this.out_value_MMK]);
                this.$store.commit('setSellStatus', this.data.status);
                this.$store.commit('setStatus', [this.sell_status, this.buy_status]);
                this.$store.commit('setTransaction', [this.in_value, this.in_value_MMK, this.out_value, this.out_value_MMK, this.status, this.changes]);
                this.$store.commit('setResults', [this.transaction, this.getGroups]);
            },

            calculateTotalAndChanges(group, note, class_value, i, j, k) {
                if (this.sheets[i][j][k] >= 0 && this.sheets[i][j][k] <= note.class_sheet[k].sheet) {
                    this.$store.commit('setSellNotEnoughMsg', '');
                    this.current_value_mmk[i][j][k] = class_value * note.note_name * this.sheets[i][j][k];
                    this.current_value[i][j][k] = note.note_name * this.sheets[i][j][k];

                    this.total_mmk = this.sum(this.current_value_mmk);
                    this.total = this.sum(this.current_value);
                    this.refreshGroup('sell', this.getGroups, this.sheets[i][j][k], group, note, k);
                    this.$store.commit('setOutValues', [this.total, this.total_mmk]);
                    this.$store.commit('isExceed', [this.in_value_MMK, this.out_value_MMK]);
                    this.$store.commit('setSellStatus', this.data.status);
                    this.$store.commit('setStatus', [this.sell_status, this.buy_status]);
                    this.$store.commit('setTransaction', [this.in_value, this.in_value_MMK, this.out_value, this.out_value_MMK, this.status, this.changes]);
                    this.$store.commit('setResults', [this.transaction, this.getGroups]);
                } else {
                    this.$store.commit('setSellNotEnoughMsg', 'Not enough sheet in the branch!');
                }
            },

        },
        mounted() {
            this.setInitialGroups('sell', this.data, true);
            this.resetStore();
            this.current_value_mmk = JSON.parse(JSON.stringify(this.sheets));
            this.current_value = JSON.parse(JSON.stringify(this.sheets));
        },
        created() {
            let lengths = {
                groups: this.groups,
                notes: this.notes,
                classes: this.classes
            };
            this.setInitialSheets(lengths, this.sheets, true)
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
