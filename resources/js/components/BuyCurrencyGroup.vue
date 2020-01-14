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

        <tr>
            <td class="border-top-0 text-nb-mount" style="padding: 30px;"></td>
            <td class="text-left border-top-0">
                <p class="total-text-mount pl-5 ">Total :<span class="total_value"></span><i>{{total_mmk}} MMKs</i></p>
                <p class=" total-text-mount fontsize-mount3 pl-5">ပြန်အမ်းငွေ : {{changes}} MMKs</p>
                <span class="text-danger">{{exceed_msg}}</span>
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
                current_value: [],
                groups: this.data.groups.length,
                notes: 10, //maximum possible number of notes in a group
                total_mmk: 0,
                changes: 0,
                exceed_msg: ''

            }
        },

        methods: {
            calculateTotalAndChanges(group,note,i,j){
                this.exceed_msg='';
                if(this.sheets[i][j]>=0){
                    this.current_value[i][j] = group.currency_value.value * note.note_name * this.sheets[i][j];

                    this.total_mmk = this.current_value.reduce(function (a, b) {
                        return a.concat(b)
                    }) // flatten array
                        .reduce(function (a, b) {
                            return a + b
                        });
                    if(this.sellTotal>=this.total_mmk){
                        this.changes= this.sellTotal-this.total_mmk;
                    }else{
                        this.exceed_msg = 'Error';
                    }
                }


            }
        },
        mounted() {
            console.log(this.sellTotal)

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
            sellTotal() {
                return this.$store.state.sell_total_mmk;
            },
        },
    }

</script>
