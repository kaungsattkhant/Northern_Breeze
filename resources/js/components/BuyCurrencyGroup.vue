<template>

    <tbody class="rounded-table-mount " v-on:load="setInitialGroups()">
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
                <p class="total-text-mount pl-5 ">Total MMKs:<span class="total_value"></span><i>{{total_mmk}} </i></p>
                <p class="total-text-mount pl-5 ">Total :<span class="total_value"></span><i>{{total}}</i></p>
            </td>
        </tr>


    </tbody>


</template>

<script>
    import Vuex from 'vuex'
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
                not_enough_msg: '',
            }
        },

        methods: {
            setInitialGroups(){
                let _this = this;
                let newGroup = JSON.parse(JSON.stringify(this.data));
                newGroup.groups.forEach(function(group){
                    group.type = 'buy';
                    group.notes.forEach(function (note) {
                        note.total_sheet=0;
                    });
                    _this.$store.commit('addGroup',group);

                });
            },

            calculateTotalAndChanges(group,note,i,j){
                let targetGroup=this.getGroups.find(function(groupItem){
                    return groupItem.group_id===group.group_id && groupItem.type==='buy';
                });
                let oldNote = targetGroup.notes.find(function (noteItem) {
                    return noteItem.group_note_id === note.group_note_id;
                });
                let index = targetGroup.notes.indexOf(oldNote);
                if(index>-1){
                    targetGroup.notes.splice(index,1);
                }
                if(this.sheets[i][j] >=0 && this.sheets[i][j]<=note.total_sheet){
                    this.not_enough_msg = '';
                    this.current_value_mmk[i][j] = group.currency_value.value * note.note_name * this.sheets[i][j];
                    this.current_value[i][j] = note.note_name*this.sheets[i][j];
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
                    this.$store.commit('setBuyTotal',this.total_mmk);
                    let data_for_transaction = {
                        in_value: this.total,
                        in_value_mmk: this.total_mmk,
                        member_id: null,
                    };
                    this.$store.commit('transactionDataFromBuyCurrency',data_for_transaction);
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
            getGroups(){
                return this.$store.state.groups;
            },
            getResults(){
                return this.$store.state.results;
            }

        },

    }

</script>
