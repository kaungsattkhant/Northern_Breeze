<template>

    <tbody class="rounded-table-mount ">
        <tr v-for="(group,i) in data.groups" >
            <h3>{{group.group_name}}</h3>
            <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2" style="display: block" v-for="(note,j) in group.notes">
                {{note.note_name}}
                <input type="number" v-model="sheets[i][j]" v-on:keyup="calculateTotalAndChanges(group,note,i,j)" v-on:change="calculateTotalAndChanges(group,note,i,j)"
                       class="from_note_class border rounded-table-mount w-25 text-center fontsize-mount3 pt-1"
                       placeholder=""
                       onchange="">
            </td>
        </tr>
        <span class="text-danger">{{not_enough_msg}}</span>

        <tr>
            <td class="border-top-0 text-nb-mount" style="padding: 30px;"></td>
            <td class="text-left border-top-0">
                <p class="total-text-mount pl-5 ">Total MMKs :<span class="total_value"></span><i>{{total_mmk}} </i></p>
                <p class="total-text-mount pl-5 ">Total :<span class="total_value"></span><i>{{total}}</i></p>
                <p class=" total-text-mount fontsize-mount3 pl-5">ပြန်အမ်းငွေ : {{changes}} MMKs</p>
                <span class="text-danger">{{exceed_msg}}</span>
            </td>
        </tr>


    </tbody>


</template>

<script>
    import Vuex, {mapState} from 'vuex'
    Vue.use(Vuex);
    import Vue from 'vue';

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
                // changes: this.$store.state.changes,
                // exceed_msg: this.$store.state.exceed_msg,
                not_enough_msg: '',

            }
        },

        methods: {
            setInitialGroups(){
                let _this = this;

                let newGroup = JSON.parse(JSON.stringify(this.data));

                newGroup.groups.forEach(function(group){
                    group.type = 'sell';
                    group.notes.forEach(function (note) {
                        note.total_sheet=0;
                    });
                    _this.$store.commit('addGroup',group)
                });
            },
            calculateTotalAndChanges(group,note,i,j){
                let targetGroup=this.getGroups.find(function(groupItem){
                    return groupItem.group_id===group.group_id && groupItem.type==='sell';
                });
                let oldNote = targetGroup.notes.find(function (noteItem) {
                    return noteItem.group_note_id === note.group_note_id;
                });
                let index = targetGroup.notes.indexOf(oldNote);
                if(index>-1){
                    targetGroup.notes.splice(index,1);
                }

                this.exceed_msg='';
                if(this.sheets[i][j]>=0 && this.sheets[i][j]<=note.total_sheet){
                    this.not_enough_msg = '';
                    let currency_value;
                    if(group.currency_value){
                        currency_value=group.currency_value.value;
                    }else{
                        currency_value=1;
                    }

                    this.current_value_mmk[i][j] = currency_value * note.note_name * this.sheets[i][j];
                    this.current_value[i][j] = note.note_name * this.sheets[i][j];

                    this.total_mmk = this.current_value_mmk.reduce(function (a, b) {
                        return a.concat(b)
                    }) // flatten array
                        .reduce(function (a, b) {
                            return a + b
                        });
                    this.total = this.current_value.reduce(function (a, b) {
                        return a.concat(b)
                    }) // flatten array
                        .reduce(function (a, b) {
                            return a + b
                        });
                    let newNote = JSON.parse(JSON.stringify(note));
                    newNote.total_sheet = this.sheets[i][j];
                    targetGroup.notes.push(newNote);
                    this.$store.commit('setSellTotal',this.total_mmk);
                    this.$store.commit('isExceed',[this.buyTotal,this.sellTotal]);

                    // if(this.buyTotal>=this.total_mmk){
                    //     this.changes = this.buyTotal-this.total_mmk;
                    // }else{
                    //     this.exceed_msg = 'Error';
                    // }
                    // if(this.buyTotal>=this.sellTotal){
                    //     this.$store.commit('setChanges',this.buyTotal-this.sellTotal);
                    // }else{
                    //     this.$store.commit('setExceedMsg',"Error");
                    // }

                    // if(this.buyTotal>=this.total_mmk){
                    //     this.changes= this.buyTotal-this.total_mmk;
                    // }else{
                    //     this.exceed_msg = 'Error';
                    // }

                    this.transaction.in_value=this.in_value;
                    this.transaction.in_value_mmk=this.in_value_mmk;
                    this.transaction.out_value=this.total;
                    this.transaction.out_value_mmk=this.total_mmk;
                    this.transaction.changes=this.changes;
                    this.$store.commit('setSellStatus',this.data.status);
                    console.log(this.buy_status)
                    this.$store.commit('setStatus',[this.sell_status,this.buy_status]);
                    this.transaction.status=this.status;


                    this.$store.commit('setTransaction',this.transaction);
                    // this.$store.commit('setDataFromSellGroups',[this.total,this.total_mmk,this.changes]);

                    this.$store.commit('setResults',[this.transaction,this.getGroups]);
                    console.log(this.getResults);

                }else{
                    this.not_enough_msg = 'Invalid Value!'
                }


            }
        },
        mounted() {

            this.setInitialGroups();
            for(let i=0; i<this.sheets.length; i++){
                this.current_value_mmk[i] = this.sheets[i].slice();
            }
            for(let i=0; i<this.sheets.length; i++){
                this.current_value[i] = this.sheets[i].slice();
            }

        },
        updated(){
        },
        created(){
            for(let i=0; i<this.groups; i++){
                let row = [];
                for(let j=0; j<this.notes; j++){
                    row.push(0);
                }
                this.sheets.push(row);
            }
        },
        computed: {

            ...mapState({
                exceed_msg: 'exceed_msg',
                changes: 'changes'
            }),
            buyTotal() {
                return this.$store.state.buy_total_mmk;
            },
            sellTotal() {
                return this.$store.state.sell_total_mmk;
            },

            in_value(){
                return this.$store.state.in_value;
            },
            in_value_mmk(){
                return this.$store.state.in_value_mmk;
            },
            status(){
                return this.$store.state.status;
            },
            sell_status(){
                return this.$store.state.sell_status;
            },
            buy_status(){
                return this.$store.state.buy_status;
            },


            // exceed_msg(){
            //     return this.$store.state.exceed_msg;
            //
            // },
            // ...mapGetters({
            //     exceed_msg: 'exceed_msg',
            //     changes: 'changes'
            // }),
            // exceed_msg: {
            //     get(){
            //         return this.$store.state.exceed_msg;
            //     }
            // },
            // changes: {
            //     get(){
            //         return this.$store.state.changes;
            //     }
            // },

            // changes(){
            //     return this.$store.state.changes;
            // },

            transaction(){
                return this.$store.state.transactionDataFromBuyCurrency;
            },
            getGroups(){
                return this.$store.state.groups;
            },
            getResults(){
                return this.$store.state.results;
            }
        },
    }

</script>
