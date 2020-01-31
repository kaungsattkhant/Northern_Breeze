<template>
    <div class="container-nb-mount">
        <form>
            <div class="d-flex justify-content-between top-box-mount shadow-sm">
                <div class="my-auto">
                    <p style="margin-left: 20px"><b>Total values:</b><i> MMKs</i></p>
                </div>
                <button type="button"
                        :disabled="isTransferDisable()"
                        v-on:click="handleSubmit()" id="trans-btn" class="btn btn-nb-mount-save fontsize-mount px-4 stock_create">Transfer</button>
            </div>
            <div class="row justify-content-between d-flex mx-0">
                <div class="">
                    <select
                        v-on:change="fetch_currency_groups(null)"
                        class="selectpicker  mt-4" name="currency" data-style="btn-white" data-width="auto"
                        data-live-search="true" id="stock_currency">
                        <option :value="null" disabled selected>Choose Currency</option>
                        <option :value="item.id"
                                v-for="item in items">{{item.name}}
                        </option>
                    </select>
                </div>
                <div v-if="is_admin" style="padding-left: 33px">
                    <select
                        v-on:change="fetch_currency_groups('from')"
                        class="selectpicker mt-4 branches" name="branch" data-style="btn-white" data-width="auto"
                        id="from_stock_branch">
                        <option :value="null" disabled selected>From Branch</option>
                        <option :value="item.id"
                                v-bind:disabled="item.id === current_branch || item.id === auth_id || isSupplierDisabled(item)"
                                v-for="item in branch_items">{{item.name}}
                        </option>
                    </select>
                </div>
                 <div class="">
                    <select
                        v-on:change="fetch_currency_groups('to')"
                        class="selectpicker mt-4 branches" name="branch" data-style="btn-white" data-width="auto"
                        id="to_stock_branch">
                        <option :value="null" disabled selected>To Branch</option>
                        <option :value="item.id"
                                v-bind:disabled="item.id === current_branch || item.id === auth_id"
                                v-for="item in branch_items">{{item.name}}
                        </option>
                    </select>
                </div>

            </div>

            <stock-group-value v-if="stock_currency" :data="stock_currency" :isMM="isMM()" :isSupplier="isSupplier()" :isTransfer="true"></stock-group-value>
        </form>

    </div>
</template>

<script>
    import Vuex, {mapState} from 'vuex'
    import Vue from 'vue';

    Vue.use(Vuex);

    export default {
        props: ['currencies', 'branches', 'total_value','is_admin','auth_id'],
        data() {
            return {
                items: JSON.parse(this.currencies),
                branch_items: JSON.parse(this.branches),
                currency_id: '',
                to_branch: '',
                from_branch: '',
                stock_currency: '',
                current_branch: '',
            }
        },

        methods: {

            isTransferDisable() {
                return !!(this.msg);
            },
            isSupplierDisabled(item){
                return item.branch_type_id === 2;
            },

            isMM(){
                return this.stock_currency.status === "MMK";
            },
            isSupplier(){
                return this.to_branch === 5;
            },

            fetch_currency_groups(type) {
                this.stock_currency = '';
                let currency_type = $('#stock_currency option:selected').val();
                let to_branch = $('#to_stock_branch option:selected').val();
                let from_branch = $('#from_stock_branch option:selected').val();

                if(type!==null){
                    this.current_branch = parseInt($('#' + type + '_stock_branch option:selected').val());
                }

                console.log(this.current_branch)


                if(this.is_admin){
                    if(currency_type !== '' && to_branch !=='' && from_branch !== ''){
                        this.currency_id = parseInt(currency_type);
                        this.to_branch = parseInt(to_branch);
                        this.from_branch = parseInt(from_branch);
                    }
                }else{
                    if(currency_type !== '' && to_branch !==''){
                        this.currency_id = parseInt(currency_type);
                        this.to_branch = parseInt(to_branch);
                        this.from_branch = null;
                    }
                }



                if(this.to_branch !== '' && this.currency_id !== '' && this.from_branch !=='' ){
                    let data = {
                        currency_id: this.currency_id,
                        to_branch: this.to_branch,
                        from_branch: this.from_branch,
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
                            this.stock_currency=data;


                        });
                }
            },

            handleSubmit() {
                $('#trans-btn').append(`
                    <i class="fa fa-spinner fa-spin"></i>
                `).prop('disabled',true);
                let transfer_type;
                if(this.isSupplier()){
                    transfer_type = 'branch_to_supplier'
                }else{
                    transfer_type = 'branch_to_branch'
                }
                let data = {
                    to_branch: this.to_branch,
                    from_branch: this.from_branch,
                    currency_id: this.currency_id,
                    groups: this.stock_groups,
                    status: this.stock_currency.status,
                    transfer_type: transfer_type,
                };

                fetch('/stock/transfer_currency', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify(data)
                })
                    .then(response => response.json())
                    .then(data => {
                        if(data.is_success){
                            window.location.replace('/stock')
                        }else{
                            $("#trans-btn").children("i:first").remove();
                            $('#trans-btn').prop('disabled',false);
                        }
                    })
            },
        },
        mounted() {

        },
        updated(){
            $('.selectpicker').selectpicker('refresh');
        },
        computed: mapState({
            stock_groups: 'stock_groups',
            msg: 'msg_for_stock'
        }),
    }

</script>
