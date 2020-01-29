<template>

    <div class="container-nb-mount">
        <form>
            <div class="d-flex justify-content-between top-box-mount shadow-sm">
                <div class="my-auto">
                    <p style="margin-left: 20px"><b>Total values:</b><i> {{total_value}}MMKs</i></p>
                </div>
                <button type="submit" class="btn btn-nb-mount-save fontsize-mount px-4 stock_create">Add</button>
            </div>
            <div class="row">
                <div class="col">
                    <select class="selectpicker  mt-4" name="currency" data-style="btn-white" data-width="auto"
                            data-live-search="true" id="stock_currency">
                        <option disabled selected>Choose Currency</option>
                        <option :value="item.id"
                                v-for="item in items">{{item.name}}
                        </option>
                    </select>
                </div>
                <div v-if="is_admin" class="col" id="branch">
                    <select
                        v-on:change="fetch_currency_groups()"
                        class="selectpicker mt-4" name="branch" data-style="btn-white" data-width="auto"
                            id="stock_branch">
                        <option disabled selected>Choose Branch</option>
                        <option :value="item.id"
                                v-bind:disabled="item.id === auth_id"
                                v-for="item in branch_items">{{item.name}}
                        </option>
                    </select>
                </div>
            </div>
            <div class="row" id="stock_table_filter">

            </div>
        </form>

    </div>

</template>
<script>
    import Vuex, {mapState} from 'vuex'
    import Vue from 'vue';

    Vue.use(Vuex);

    export default {
        props: ['currencies', 'branches', 'auth_id', 'total_value','is_admin'],
        data() {
            return {
                items: JSON.parse(this.currencies),
                branch_items: JSON.parse(this.branches),
                currency_id: '',
                branch: ''
            }
        },

        methods: {

            fetch_currency_groups() {
                this.groups = '';
                this.currency_id = parseInt($('#stock_currency option:selected').val());
                if(this.is_admin){
                    this.branch = parseInt($('#stock_branch option:selected').val());
                }else{
                    this.branch= null;
                }
                let data = {
                    currency_id: this.currency_id,
                    branch: this.branch
                };
                fetch('/stock/currency_filter', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify(data)
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                    });
            },

            // submitForm() {
            //     fetch('/daily_currency/store', {
            //         method: 'POST',
            //         headers: {
            //             'Content-Type': 'application/json',
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         },
            //         body: JSON.stringify(this.daily_currency_data)
            //     })
            //         .then(response => response.json())
            //         .then(data => {
            //             console.log(data);
            //         })
            // },
        },
        mounted() {

        },
        computed: mapState({}),


    }

</script>
