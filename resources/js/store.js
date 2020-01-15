import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        buy_total_mmk: 0,
        transactionDataFromBuyCurrency: {},
        transaction: {},
        groups: [],
        results: {}
    },
    mutations: {
        setBuyTotal(state,data){
            state.buy_total_mmk=data;
            this.buy_total_mmk = state.buy_total_mmk;
        },
        transactionDataFromBuyCurrency(state,data){
          state.transactionDataFromBuyCurrency = data;
            this.transactionDataFromBuyCurrency=state.transactionDataFromBuyCurrency;
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
