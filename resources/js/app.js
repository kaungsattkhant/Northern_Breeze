/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('bootstrap');
import axios from 'axios';

import VueAxios from 'vue-axios'

import {store} from './store';

window.Vue = require('vue');
Vue.use(VueAxios, axios);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('non-member', require('./components/NonMember.vue').default);
Vue.component('daily-currency', require('./components/DailyCurrency.vue').default);
Vue.component('group-value', require('./components/GroupValue.vue').default);
Vue.component('add-stock-inventory', require('./components/AddStockInventory.vue').default);
Vue.component('transfer-stock-inventory', require('./components/TransferStockInventory.vue').default);
Vue.component('stock-group-value', require('./components/StockGroupValue.vue').default);
Vue.component('member', require('./components/Member.vue').default);
Vue.component('buy-currency-group', require('./components/BuyCurrencyGroup.vue').default);
Vue.component('member-buy-currency-group', require('./components/MemberBuyCurrencyGroup.vue').default);
Vue.component('sell-currency-group', require('./components/SellCurrencyGroup.vue').default);
Vue.component('member-sell-currency-group', require('./components/MemberSellCurrencyGroup.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,

});
