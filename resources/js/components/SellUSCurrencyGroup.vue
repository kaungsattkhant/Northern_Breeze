<template>

    <tbody class="rounded-table-mount ">
    <tr v-for="(group,i) in data.groups" >
        <h3>{{group.group_name}}</h3>
        <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2" style="display: block" v-for="(note,j) in group.notes">
            {{note.note_name}}
            <input type="number" v-model="sheets[i][j][k]"  v-for="(item,k) in group.class_currency_value"  placeholder="Class "
                   v-on:keyup="calculateTotalAndChanges(note,item.value,i,j,k)" v-on:change="calculateTotalAndChanges(note,item.value,i,j,k)"
                   class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1 ">

<!--            <input type="number" v-model="sheets[i][j]" v-on:keyup="calculateTotalAndChanges(group,note,i,j)" v-on:change="calculateTotalAndChanges(group,note,i,j)"-->
<!--                   class="from_note_class border rounded-table-mount w-25 text-center fontsize-mount3 pt-1"-->
<!--                   placeholder=""-->
<!--                   onchange="">-->
        </td>
    </tr>

    <tr>
        <td class="border-top-0 text-nb-mount" style="padding: 30px;"></td>
        <td class="text-left border-top-0">
            <p class="total-text-mount pl-5 ">Total :<span class="total_value"></span><i>{{total_mmk}} MMKs</i></p>
<!--            <p class=" total-text-mount fontsize-mount3 pl-5">ပြန်အမ်းငွေ : {{changes}} MMKs</p>-->
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
        data(){
            return{
                sheets: [],
                current_value: [],
                groups: this.data.groups.length,
                notes: 4, //maximum possible number of notes in a group
                classes: 4,//maximum possible number of classes in a note
                total_mmk: 0,
                // changes: 0
            }
        },
        methods: {
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
            calculateTotalAndChanges(note,class_value,i,j,k){
                if(this.sheets[i][j][k]>=0){
                    this.current_value[i][j][k] = class_value * note.note_name * this.sheets[i][j][k];
                    this.total_mmk = this.arrSum(this.current_value);
                    this.$store.commit('setSellTotal',this.total_mmk);
                }


            },

        },
        mounted() {
            const deepCopy = (arr) => {
                let copy = [];
                arr.forEach(elem => {
                    if(Array.isArray(elem)){
                        copy.push(deepCopy(elem))
                    }else{
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
        },
        created(){
            for(let i=0; i<this.groups; i++){
                let row = [];
                for(let j=0; j<this.notes; j++){
                    let column = [];
                    for(let k=0; k<this.classes; k++){
                        column.push(0);
                    }
                    row.push(column);
                }
                this.sheets.push(row);
            }
        }
    }
</script>
