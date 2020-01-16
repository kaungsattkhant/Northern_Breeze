import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        buy_total_mmk: 0,
        sell_total_mmk: 0,
        transaction: {
            in_value: 0,
            out_value: 0,
            in_value_MMK: 0,
            out_value_MMK: 0,
            changes: 0,
            member_id: null,
            status: '',
        },
        in_value: 0,
        out_value: 0,
        in_value_MMK: 0,
        out_value_MMk: 0,
        // changes: 0,
        member_id: null,
        status: '',
        buy_status: '',
        sell_status: '',
        groups: [],
        results: {},
        exceed_msg: '',
        changes:0,
        buy_not_enough_msg: '',
        sell_not_enough_msg: '',
    },

    getters: {
        exceed_msg: (state) => {
            return state.exceed_msg;
        },
        changes: (state) => {
            return state.changes;
        },

    },
    mutations: {
        setBuyNotEnoughMsg(state,data){
            state.buy_not_enough_msg= data;
            this.buy_not_enough_msg = state.buy_not_enough_msg;
        },
         setSellNotEnoughMsg(state,data){
            state.sell_not_enough_msg= data;
            this.sell_not_enough_msg = state.sell_not_enough_msg;
        },

        setTransactionDataFromBuyGroups(state,data){
            state.in_value = data[0];
            state.in_value_MMK = data[1];
            this.in_value=state.in_value;
            this.in_value_MMK=state.in_value_MMK;
        },

        setTransactionDataFromSellGroups(state,data){
            state.out_value = data[0];
            state.out_value_MMK = data[1];
            this.out_value=state.out_value;
            this.out_value_MMK=state.out_value_MMK;
        },
        setSellStatus(state,data){
            state.sell_status = data;
            this.sell_status = state.sell_status;
        },
        setBuyStatus(state,data){
            state.buy_status = data;
            this.buy_status = state.buy_status;
        },
        setStatus(state,data){
            state.status = data[1]+'_'+data[0];
            this.status = state.status;
        },
        setTransaction(state,data){
            state.transaction = data;
            this.transaction = state.transaction;
        },

        setBuyTotal(state,data){
            state.buy_total_mmk=data;
            this.buy_total_mmk = state.buy_total_mmk;
        },
        setSellTotal(state,data){
            state.sell_total_mmk=data;
            this.sell_total_mmk = state.sell_total_mmk;
        },

        isExceed(state,data){
            if(data[0]>=data[1]){
                state.exceed_msg = '';
                state.changes = data[0]-data[1];
            }else{
                state.exceed_msg = 'Error'
            }
            this.changes = state.changes;
            this.exceed_msg = state.exceed_msg;
        },

        transactionDataFromBuyCurrency(state,data){
          state.transactionDataFromBuyCurrency = data;
            this.transactionDataFromBuyCurrency=state.transactionDataFromBuyCurrency;
        },
        classTransactionDataFromBuyCurrency(state,data){
          state.classTransactionDataFromBuyCurrency = data;
            this.classTransactionDataFromBuyCurrency=state.classTransactionDataFromBuyCurrency;
        },

        allTransaction(state,data){
          state.transaction = data;
            this.transaction=state.transaction;
        },


        setResults(state,data){
            state.results.transaction = data[0];
            state.results.groups = data[1];

            this.results = state.results;
        },


        addGroup(state,data){
            this.groups = state.groups.push(data);
        },


    },

});
