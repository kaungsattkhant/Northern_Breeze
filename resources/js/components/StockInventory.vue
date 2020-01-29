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
                            data-live-search="true" id="stock_currency_filter">
                        <option disabled selected>Currency Value</option>
                        <option :value="item.id"
                                v-for="item in items">{{item.name}}
                        </option>
                    </select>
                </div>
                <div class="col" id="branch">
                    <select class="selectpicker mt-4" name="branch" data-style="btn-white" data-width="auto"
                            id="to_branch">
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
        props: ['currencies', 'branches', 'auth_id', 'total_value'],
        data() {
            return {
                items: JSON.parse(this.currencies),
                branch_items: JSON.parse(this.branches),
                groups: '',
                currency_id: ''
            }
        },

        methods: {

            fetch_currency_groups() {
                this.groups = '';
                this.currency_id = parseInt($('#currency_filter option:selected').val());
                let data = {
                    currency_id: this.currency_id,
                };
                fetch('/daily_currency/currency_filter', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify(data)
                })
                    .then(response => response.json())
                    .then(data => {
                        this.groups = data.results;
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
