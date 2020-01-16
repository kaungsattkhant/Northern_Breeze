import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        buy_total_mmk: 0,
        sell_total_mmk: 0,
        class_buy_total_mmk: 0,
        class_sell_total_mmk: 0,
        transactionDataFromBuyCurrency: {},
        classTransactionDataFromBuyCurrency: {},
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
        class_transaction: {},
        groups: [],
        class_groups: [],
        results: {},
        class_results: {},
        exceed_msg: '',
        class_exceed_msg: '',
        changes:0,
        class_changes:0
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


        // setTransaction(state,data){
        //     state.transaction = data;
        //     this.transaction = state.transaction;
        //     // state.transaction.in_value =Object.assign(state.transaction, data[0])
        //     // this.transaction.in_value =Object.assign(this.transaction, state.transaction);
        //     // state.transaction['in_value']= data[0];
        //     // state.transaction['in_value_mmk']= data[1];
        //     // this.transaction['in_value']=state.transaction['in_value'];
        //     // this.transaction['in_value_mmk']=state.transaction['in_value_mmk'];
        // },
        // setDataFromSellGroups(state,data){
        //     state.transaction['out_value']= data[0];
        //     state.transaction['out_value_mmk']= data[1];
        //     state.transaction['changes']= data[2];
        //     this.transaction['out_value']=state.transaction['out_value'];
        //     this.transaction['out_value_mmk']=state.transaction['out_value_mmk'];
        //     this.transaction['changes']=state.transaction['changes'];
        // },

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
        // isClassExceed(state,data){
        //     if(data[0]>=data[1]){
        //         state.class_exceed_msg = '';
        //         state.class_changes = data[0]-data[1];
        //     }else{
        //         state.class_exceed_msg = 'Error'
        //     }
        //     this.class_changes = state.class_changes;
        //     this.class_exceed_msg = state.class_exceed_msg;
        // },


        setClassBuyTotal(state,data){
            state.class_buy_total_mmk=data;
            this.class_buy_total_mmk = state.class_buy_total_mmk;
        },
         setClassSellTotal(state,data){
            state.class_sell_total_mmk=data;
            this.class_sell_total_mmk = state.class_sell_total_mmk;
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
         allClassTransaction(state,data){
          state.class_transaction = data;
            this.class_transaction=state.class_transaction;
        },

        setResults(state,data){
            state.results.transaction = data[0];
            state.results.groups = data[1];

            this.results = state.results;
        },
        setClassResults(state,data){
            state.class_results.transaction = data[0];
            state.class_results.groups = data[1];

            this.class_results = state.class_results;
        },

        addGroup(state,data){
            this.groups = state.groups.push(data);
        },
        addClassGroup(state,data){
            this.class_groups = state.class_groups.push(data);
        },

    },

});
