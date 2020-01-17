<template>

    <tbody class="rounded-table-mount ">
        <tr>

            <!--        <td class="border-top-0 text-nb-mount d-none" style="padding: 30px;"></td>-->
            <td class="text-center border-top-0">
                <p class="total-text-mount pl-5 ">Total MMKs :<span class="total_value"></span><i>{{total_mmk}} </i></p>
                <p class="total-text-mount pl-5 ">Total :<span class="total_value"></span><i>{{total}}</i></p>
                <p class=" total-text-mount fontsize-mount3 pl-5">ပြန်အမ်းငွေ : {{changes}} MMKs</p>
                <span class="text-danger">{{exceed_msg}}</span>

            </td>
        </tr>
        <tr v-for="(group,i) in data.groups">
            <h5 class="pt-3 text-center mb-0">{{group.group_name}}</h5>
            <td class="text-nb-mount border-top-0 pl-4 pt-3 justify-content-between fontsize-mount2" style="display: flex"
                v-for="(note,j) in group.notes">
                <span class="fontsize-mount22 span-number">{{note.note_name}}</span>
                <div class="input-group-box">
                    <input type="number" v-model="sheets[i][j][k]" v-for="(item,k) in group.class_currency_value"
                           placeholder="Class "
                           v-on:keyup="calculateTotalAndChanges(group,note,item.value,i,j,k)"
                           v-on:change="calculateTotalAndChanges(group,note,item.value,i,j,k)"
                           class="border rounded-table-mount float-right w-25 text-center fontsize-mount3 pt-1 ">
                </div>
            </td>
        </tr>
        <span class="text-danger">{{sell_not_enough_msg}}</span>


    </tbody>

</template>

<script>
    import Vuex, {mapState} from 'vuex'
    import Vue from 'vue';

    Vue.use(Vuex);
    export default {
        props: ['data'],
        data() {
            return {
                sheets: [],
                current_value: [],
                current_value_mmk: [],
                groups: this.data.groups.length,
                notes: 4, //maximum possible number of notes in a group
                classes: 4,//maximum possible number of classes in a note
                total_mmk: 0,
                total: 0,
            }
        },
        methods: {

            setInitialGroups() {
                let _this = this;
                let newGroup = JSON.parse(JSON.stringify(this.data));
                newGroup.groups.forEach(function (group) {
                    group.type = 'sell';
                    group.notes.forEach(function (note) {

                        let total_sheet = 0;
                        note.class_sheet.forEach(function (item) {

                            item.sheet = 0;
                            total_sheet = total_sheet + item.sheet;
                        });
                        note.total_sheet = total_sheet;
                    });
                    _this.$store.commit('addGroup', group);
                });
            },

            arrSum(arr) {
                let sum = 0;
                for (let i = 0; i < arr.length; i++) {
                    if (typeof arr[i] == 'object')
                        sum += this.arrSum(arr[i]);
                    else
                        sum += arr[i];
                }
                return sum;
            },
            calculateTotalAndChanges(group, note, class_value, i, j, k) {
                let targetGroup = this.getGroups.find(function (groupItem) {
                    return groupItem.group_id === group.group_id && groupItem.type === 'sell';
                });
                let oldNote = targetGroup.notes.find(function (noteItem) {
                    return noteItem.group_note_id === note.group_note_id;
                });
                let oldClass = oldNote.class_sheet.find(function (classItem) {
                    return classItem.class_id === note.class_sheet[k].class_id;
                });
                let index = oldNote.class_sheet.indexOf(oldClass);
                if (index > -1) {
                    oldNote.class_sheet.splice(index, 1);
                }


                if (this.sheets[i][j][k] >= 0 && this.sheets[i][j][k] <= note.class_sheet[k].sheet) {
                    this.$store.commit('setSellNotEnoughMsg', '');


                    this.current_value_mmk[i][j][k] = class_value * note.note_name * this.sheets[i][j][k];
                    this.current_value[i][j][k] = note.note_name * this.sheets[i][j][k];
                    this.total_mmk = this.arrSum(this.current_value_mmk);
                    this.total = this.arrSum(this.current_value);

                    let newClass = JSON.parse(JSON.stringify(note.class_sheet[k]));
                    newClass.sheet = this.sheets[i][j][k];
                    oldNote.class_sheet.push(newClass);

                    this.getGroups.forEach(function (groupItem) {
                        if (groupItem.type === 'sell') {
                            groupItem.notes.forEach(function (noteItem) {
                                let total_sheet = 0;
                                noteItem.class_sheet.forEach(function (classItem) {
                                    total_sheet = total_sheet + parseInt(classItem.sheet);
                                });
                                noteItem.total_sheet = total_sheet;
                            });
                        }

                    });
                    this.$store.commit('setSellTotal', this.total_mmk);

                    this.$store.commit('isExceed', [this.buyTotal, this.sellTotal]);
                    this.$store.commit('setTransactionDataFromSellGroups', [this.total, this.total_mmk]);

                    this.transaction.in_value = this.in_value;
                    this.transaction.in_value_MMK = this.in_value_MMK;
                    this.transaction.out_value = this.total;
                    this.transaction.out_value_MMK = this.total_mmk;
                    this.transaction.changes = this.changes;
                    this.$store.commit('setSellStatus', this.data.status);
                    this.$store.commit('setStatus', [this.sell_status, this.buy_status]);
                    this.transaction.status = this.status;
                    this.$store.commit('setTransaction', this.transaction);

                    this.$store.commit('setResults', [this.transaction, this.getGroups]);

                } else {
                    this.$store.commit('setSellNotEnoughMsg', 'Not enough sheet in the branch!');

                }


            },

        },
        mounted() {

            this.setInitialGroups();
            const deepCopy = (arr) => {
                let copy = [];
                arr.forEach(elem => {
                    if (Array.isArray(elem)) {
                        copy.push(deepCopy(elem))
                    } else {
                        if (typeof elem === 'object') {
                            copy.push(deepCopyObject(elem))
                        } else {
                            copy.push(elem)
                        }
                    }
                });
                return copy;
            };

            this.current_value = deepCopy(this.sheets);
            this.current_value_mmk = deepCopy(this.sheets);

        },
        created() {
            for (let i = 0; i < this.groups; i++) {
                let row = [];
                for (let j = 0; j < this.notes; j++) {
                    let column = [];
                    for (let k = 0; k < this.classes; k++) {
                        column.push(0);
                    }
                    row.push(column);
                }
                this.sheets.push(row);
            }
        },
        computed: mapState({
            getGroups: 'groups',
            getResults: 'results',
            buyTotal: 'buy_total_mmk',
            sellTotal: 'sell_total_mmk',
            transaction: 'transaction',
            in_value: 'in_value',
            in_value_MMK: 'in_value_MMK',
            buy_status: 'buy_status',
            sell_status: 'sell_status',
            sell_not_enough_msg: 'sell_not_enough_msg',
            status: 'status',
            exceed_msg: 'exceed_msg',
            changes: 'changes'
        }),
    }
</script>
