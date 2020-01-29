import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        transaction: {
            in_value: 0,
            out_value: 0,
            in_value_MMK: 0,
            out_value_MMK: 0,
            changes: 0,
            member_id: null,
            status: '',
        },
        results: {},
        groups: [],
        buy_total_mmk: 0,
        sell_total_mmk: 0,
        in_value: 0,
        out_value: 0,
        in_value_MMK: 0,
        out_value_MMK: 0,
        changes: 0,
        member_id: null,
        status: '',
        buy_status: '',
        sell_status: '',
        exceed_msg: '',
        buy_not_enough_msg: '',
        sell_not_enough_msg: '',
        daily_currency_data: '',
    },
    mutations: {

        setBuyNotEnoughMsg(state, data) {
            state.buy_not_enough_msg = data;
        },
        setSellNotEnoughMsg(state, data) {
            state.sell_not_enough_msg = data;
        },

        setInValues(state, data) {
            state.in_value = data[0];
            state.in_value_MMK = data[1];
        },

        setOutValues(state, data) {
            state.out_value = data[0];
            state.out_value_MMK = data[1];
        },
        setSellStatus(state, data) {
            state.sell_status = data;
        },
        setBuyStatus(state, data) {
            state.buy_status = data;
        },
        setStatus(state, data) {
            state.status = data[1] + '_' + data[0];
        },
        setTransaction(state, data) {
            state.transaction.in_value = data[0];
            state.transaction.in_value_MMK = data[1];
            state.transaction.out_value = data[2];
            state.transaction.out_value_MMK = data[3];
            state.transaction.status = data[4];
            state.transaction.changes = data[5];
        },
        // setTransaction(state, data) {
        //     state.transaction = data;
        // },

        setBuyTotal(state, data) {
            state.buy_total_mmk = data;
        },
        setSellTotal(state, data) {
            state.sell_total_mmk = data;
        },

        isExceed(state, data) {
            if (data[0] >= data[1]) {
                state.changes = data[0] - data[1];
                state.exceed_msg = '';
            } else {
                state.changes = data[0] - data[1];
                state.exceed_msg = 'Sell value cannot exceed Buy value!'
            }
        },
        setResults(state, data) {
            state.results.transaction = data[0];
            state.results.groups = data[1];
        },
        addGroup(state, data) {
            state.groups.push(data);
        },
        removeGroup(state, data) {
            let targetGroups = state.groups.filter(function (group) {
                return group.type === data;
            });
            targetGroups.forEach(function (group) {
                let index = state.groups.indexOf(group);
                if (index > -1) {
                    state.groups.splice(index, 1);
                }
                // let item = state.results.indexOf(group);
                // if(item > -1){
                //     state.results.splice(index,1);
                // }
            });
        },
        setDailyCurrencyData(state,data){
            state.daily_currency_data = data;
        }
    },

});
