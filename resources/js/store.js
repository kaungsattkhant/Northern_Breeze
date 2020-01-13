import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        sell_total_mmk: 0
    },
    mutations: {
        setSellTotal(state,data){
            state.sell_total_mmk=data;
            this.sell_total_mmk = state.sell_total_mmk;
        }
    },
});
