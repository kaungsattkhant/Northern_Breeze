<template>


    <div class="row">

        <div class="col">
            <table class="table border-0 bg-white box-shadow-mount border-tab-radius-mount" id="stock_table_filter">
                <tbody class="rounded-table-mount" v-for="group in data.groups">

                <tr>
                    <td>
                        <h3 class="pb-2 ">
                            {{group.group_name}}  <span v-if="!isMM" style="font-size: 15px;color: #555555;font-family: 'Roboto',sans-serif">({{group.class_currency_value[0].value}})</span>
                        </h3>
                    </td>
                    <td v-if="!isMM" class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">

                    </td>
                </tr>
                <tr v-for="note in group.notes">
                    <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">{{note.note_name}}</td>
                    <td class="text-right border-top-0 pt-4">
                        <p class="text-color-mount fontsize-mount2" style="padding-bottom: 1px">{{note.total_sheet}}</p>
                    </td>
                </tr>

                <tr>
                    <td class="border-top-0 text-nb-mount d-none" style="padding: 0px;"></td>
                    <td class="text-center border-top-0 w-100 pl-5">
                        <p class="total-text-mount pl-5 mb-1">Total MMKs :<span
                            class="total_value"></span><i></i></p>

                    </td>
                </tr>

                </tbody>
            </table>
<!--            <div class="div-p-mount2">-->
<!--                <p> Total : MMKs </p>-->
<!--            </div>-->
        </div>

        <div class="col">
            <table class="table border-0 bg-white box-shadow-mount border-tab-radius-mount">
                <tbody class="rounded-table-mount pb-5" v-for="(group,i) in data.groups">
                <tr>
                    <td class="text-center w-25">
                        <h3>
                            {{group.group_name}}
                        </h3>
                    </td>
                    <td class="text-left border-top-0 pt-4 pb-4">
                        <input v-if="!isMM && isSupplier" v-for="(item,k) in group.class_currency_value"
                               type="number"
                               min="0"
                               v-on:change="handleValues(group,i)"
                               v-on:keyup="handleValues(group,i)"
                               v-model="group_value[i][k]"
                               class="note_class border-top-0 border-left-0 border-right-0 w-21 text-center fontsize-mount mx-1 pt-1" style="color: #555">
                    </td>
                </tr>
                <tr v-for="(note,j) in group.notes">
                    <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">{{note.note_name}}</td>
                    <td class="text-right border-top-0 pt-4 pb-4">

                        <input v-if="!isMM" v-for="(item,k) in group.class_currency_value"
                               type="number"
                               min="0"
                               v-on:change="handleSheets(group,note,i,j,k)"
                               v-on:keyup="handleSheets(group,note,i,j,k)"
                               v-model="note_sheets[i][j][k]"  class="note_class border rounded-table-mount w-25 text-center fontsize-mount3 pt-1">
                        <input v-if="isMM"
                               type="number"
                               min="0"
                               v-on:change="handleSheets(group,note,i,j,null)"
                               v-on:keyup="handleSheets(group,note,i,j,null)"
                               v-model="note_sheets[i][j]"  class="note_class border rounded-table-mount w-25 text-center fontsize-mount3 pt-1">

                    </td>
                </tr>
                <tr>
                    <td class="border-top-0 p-0"></td>
                    <td class="border-top-0 w-100 text-left pl-5">
                        <p class="total-text-mount pl-5 mb-1">Total MMKs :</p>
                    </td>
                </tr>
<!--                <tr>-->
<!--                    <td class="border-top-0 text-nb-mount d-none" style="padding: 0px;"></td>-->
<!--                    <td class="text-center border-top-0 w-100 pl-5">-->
<!--                        <p class="total-text-mount pl-5 mb-1">Total MMKs :<span-->
<!--                            class="total_value"></span><i></i></p>-->

<!--                    </td>-->
<!--                </tr>-->
                </tbody>
            </table>
            <span class="text-danger">{{msg}}</span>
<!--            <div class="div-p-mount2 text-center">-->
<!--                <p> Total : MMKs </p>-->
<!--            </div>-->
        </div>

    </div>


</template>
<script>
    import Vuex, {mapState} from 'vuex'
    import Vue from 'vue';
    import {helpers} from '../helpers.js'

    Vue.use(Vuex);

    export default {
        props: ['data','isMM','isSupplier'],
        data() {
            return {
                group_value: [],
                note_sheets: [],
                groups_length: this.data.groups.length,
                notes_length: 10,
                classes_length: 10,
                msg: ''
            }
        },

        methods: {
            setInitialSheets: helpers.setInitialSheetsForStock,
            setInitialGroups: helpers.setInitialGroupsForStock,
            refreshGroup: helpers.removeOldElementAndAddNewForStock,
            switchToCustomValue: helpers.switchCustomValue,

            handleValues(group,i){
                this.switchToCustomValue(this.stock_groups,group,this.group_value[i]);
            },
            handleSheets(group,note,i,j,k){
                if(this.isMM && !this.isSupplier ){
                    this.refreshGroup(null, this.stock_groups, this.note_sheets[i][j], group, note, k,this.group_value[i],(this.isMM && !this.isSupplier));

                }else{
                    this.refreshGroup(null, this.stock_groups, this.note_sheets[i][j][k], group, note, k,this.group_value[i], (this.isMM && !this.isSupplier));
                }
            },
        },
        mounted() {
            this.setInitialGroups(null, this.data, (this.isMM && !this.isSupplier));
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
            this.setInitialSheets(lengths, this.note_sheets, (this.isMM && !this.isSupplier));

        },
        computed: mapState({
            stock_groups: 'stock_groups'
        }),


    }

</script>
