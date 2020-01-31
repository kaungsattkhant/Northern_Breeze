<template>


    <div class="row">

        <div class="col">
            <table class="table border-0 bg-white box-shadow-mount border-tab-radius-mount" id="stock_table_filter">
                <tbody class="rounded-table-mount" v-for="group in data.groups">

                <tr>
                    <td>
                        <h3 class="pb-2 ">
                            {{group.group_name}}  <span v-if="!isMM" v-for="item in group.class_currency_value" style="font-size: 15px;color: #555555;font-family: 'Roboto',sans-serif">({{item.value}})</span>
                        </h3>
                    </td>
                    <td v-if="!isMM" class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">

                    </td>
                </tr>
                <tr v-for="note in group.notes">
                    <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">{{note.note_name}}</td>
                    <td class="text-right border-top-0 pt-4">
                        <p class="text-color-mount fontsize-mount2" style="padding-bottom: 0px">{{note.total_sheet}}</p>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td class="border-top-0 text-nb-mount d-none" style="padding: 0px;"></td>
                    <td class="text-center border-top-0 w-100 pl-5">
                        <p class="total-text-mount pl-5 mb-1">Total MMKs :<span
                            class="total_value"></span><i></i></p>

                    </td>
                </tr>
                </tfoot>
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
                               v-on:change="handleValues()"
                               v-on:keyup="handleValues()"
                               v-model="group_value[i][k]"
                               class="note_class border-top-0 border-left-0 border-right-0 w-21 text-center fontsize-mount mx-1 pt-1" style="color: #555">
                    </td>
                </tr>
                <tr v-for="(note,j) in group.notes">
                    <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">{{note.note_name}}</td>
                    <td class="text-right border-top-0 pt-4 pb-4">

                        <input v-if="!isMM" v-for="(item,k) in note.class_sheet"
                               type="number"
                               min="0"

                               v-on:change="handleSheets(item,i,j,k)"
                               v-on:keyup="handleSheets(item,i,j,k)"
                               v-model="note_sheets[i][j][k]"  class="note_class border rounded-table-mount w-25 text-center fontsize-mount3 pt-1">
                        <input v-if="isMM"
                               type="number"
                               min="0"
                               v-on:change="handleSheets(note,i,j,null)"
                               v-on:keyup="handleSheets(note,i,j,null)"
                               v-model="note_sheets[i][j]"  class="note_class border rounded-table-mount w-25 text-center fontsize-mount3 pt-1">

                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td class="border-top-0 px-0 text-center">
                        <span class="text-danger" v-if="isTransfer">{{msg}}</span>
                    </td>
                    <td class="border-top-0 w-100 text-left pl-5">
                        <p class="total-text-mount pl-5 mb-1">Total MMKs : {{total_mmk}}</p>
                    </td>
                </tr>
                </tfoot>
            </table>
<!--            <span class="text-danger" v-if="isTransfer">{{msg}}</span>-->
        </div>

    </div>


</template>
<script>
    import Vuex, {mapState} from 'vuex'
    import Vue from 'vue';
    import {stock_helpers} from '../stock_helpers.js'

    Vue.use(Vuex);

    export default {
        props: ['data','isMM','isSupplier','isTransfer'],
        data() {
            return {
                group_value: [],
                note_sheets: [],
                groups_length: this.data.groups.length,
                notes_length: 10,
                classes_length: 10,
                msg: '',
                groups: [],
                total_mmk: 0
            }
        },

        methods: {


            setSheetsArray: stock_helpers.setInitialSheet,
            setGroupValuesArray: stock_helpers.setInitialGroupValue,
            setGroupsArray: stock_helpers.setInitialGroups,
            refreshGroup: stock_helpers.updateInitialGroups,
            calculateTotal: stock_helpers.calculateTotalMMK,

            handleValues(){
                this.refreshGroup(this.stock_groups,this.note_sheets,this.group_value,this.isMM);
                this.total_mmk = this.calculateTotal(this.stock_groups,this.isMM);
            },

            handleSheets(item, i , j, k){
                this.msg = '';
                let total_sheet, input_sheet;
                if(this.isMM){
                    total_sheet = item.total_sheet;
                    input_sheet = this.note_sheets[i][j];
                }else{
                    total_sheet = item.sheet;
                    input_sheet = this.note_sheets[i][j][k];
                }
                if(input_sheet>total_sheet){
                    this.msg = 'Invalid Value!';
                }
                this.refreshGroup(this.stock_groups,this.note_sheets,this.group_value,this.isMM);
                this.total_mmk = this.calculateTotal(this.stock_groups,this.isMM);
                console.log(this.stock_groups);

            },
        },


        mounted() {

        },


        created(){
             let lengths = {
                    groups: this.groups_length,
                    notes: this.notes_length,
                    classes: this.classes_length
             };
            this.setGroupsArray(this.data.groups, this.isMM);
            this.setGroupValuesArray(this.group_value,lengths,this.stock_groups,this.isMM);
            this.setSheetsArray(this.note_sheets, lengths, this.isMM);
        },



        computed: mapState({
            stock_groups: 'stock_groups'
        }),


    }

</script>
