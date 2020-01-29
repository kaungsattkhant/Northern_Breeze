<template>


    <div class="row">

        <div class="col">
            <table class="table border-0 bg-white box-shadow-mount border-tab-radius-mount" id="stock_table_filter">
                <tbody class="rounded-table-mount" v-for="group in data.groups">
                <tr>
                    <td>
                        <h3 class="pb-2">
                            {{group.group_name}}
                        </h3>
                    </td>
                    <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">
                        {{group.class_currency_value[0].value}}
                    </td>
                </tr>
                <tr v-for="note in group.notes">
                    <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">{{note.note_name}}</td>
                    <td class="text-right border-top-0 pt-4">
                        <p class="text-color-mount fontsize-mount2" style="padding-bottom: 1px">{{note.total_sheet}}</p>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="div-p-mount2">
                <p> Total : MMKs </p>
            </div>
        </div>

        <div class="col">
            <table class="table border-0 bg-white box-shadow-mount d-flex rounded-table-mount mt-0 pb-1">
                <tbody class="rounded-table-mount pb-5" v-for="(group,i) in data.groups">
                <tr>
                    <td>
                        <h3>
                            {{group.group_name}}
                        </h3>
                    </td>
                    <td class="text-right border-top-0 pt-4 pb-4">
                        <input v-if="!isMM" v-for="(item,k) in group.class_currency_value"
                               type="number"
                               v-on:change="handleValues(group,i)"
                               v-on:keyup="handleValues(group,i)"
                               v-model="group_value[i][k]"
                               class="note_class border rounded-table-mount w-21 text-center fontsize-mount3 pt-1">
                    </td>
                </tr>
                <tr v-for="(note,j) in group.notes">
                    <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">{{note.note_name}}</td>
                    <td class="text-right border-top-0 pt-4 pb-4">

                        <input v-for="(item,k) in group.class_currency_value"
                               type="number"
                               v-on:change="handleSheets(group,note,i,j,k)"
                               v-on:keyup="handleSheets(group,note,i,j,k)"
                               v-model="note_sheets[i][j][k]"  class="note_class border rounded-table-mount w-21 text-center fontsize-mount3 pt-1">
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="div-p-mount2 text-center">
                <p> Total : MMKs </p>
            </div>
        </div>

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
                group_value: [],
                note_sheets: [],
                groups_length: this.data.groups.length,
                notes_length: 10,
                classes_length: 10
            }
        },

        methods: {
            setInitialSheets: helpers.setInitialSheets,
            setInitialGroups: helpers.setInitialGroups,
            refreshGroup: helpers.removeOldElementAndAddNewForStock,
            switchToCustomValue: helpers.switchCustomValue,

            handleValues(group,i){
                this.switchToCustomValue(this.stock_groups,group,this.group_value[i]);
            },
            handleSheets(group,note,i,j,k){
                this.refreshGroup(null, this.stock_groups, this.note_sheets[i][j][k], group, note, k,this.group_value[i],this.isMM);
            },
        },
        mounted() {
            this.setInitialGroups(null, this.data, this.isUS);
        },
        created(){
             let lengths = {
                    groups: this.groups_length,
                    notes: this.notes_length,
                    classes: this.classes_length
             };

            for(let i=0; i<this.groups_length; i++){
                let row = [];
                for(let j=0; j<this.classes_length; j++){
                    row.push(0);
                }
                this.group_value.push(row);
            }
            this.setInitialSheets(lengths, this.note_sheets, true);

        },
        computed: mapState({
            stock_groups: 'stock_groups'
        }),


    }

</script>
