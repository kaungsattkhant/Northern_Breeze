<template>

    <div class="container-nb-mount">
        <form>
            <div class="d-flex justify-content-between top-box-mount shadow-sm">
                <div class="my-auto">
                    <p style="margin-left: 20px"><b>Total values:</b><i> {{total_value}}MMKs</i></p>
                </div>
                <button type="button" v-on:click="handleSubmit()" id="add-btn" class="btn btn-nb-mount-save fontsize-mount px-4 stock_create">Add</button>
            </div>
            <div class="row">
                <div class="col">
                    <select
                            v-on:change="fetch_currency_groups()"
                            class="selectpicker  mt-4" name="currency" data-style="btn-white" data-width="auto"
                            data-live-search="true" id="stock_currency">
                        <option :value="null" disabled selected>Choose Currency</option>
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
                        <option :value="null" disabled selected>Choose Branch</option>
                        <option :value="item.id"
                                v-for="item in branch_items">{{item.name}}
                        </option>
                    </select>
                </div>
            </div>

            <stock-group-value v-if="stock_currency" :data="stock_currency" :isMM="isMM()" :isSupplier="true" :isTransfer="false"></stock-group-value>
        </form>

    </div>

</template>
<script>
    import Vuex, {mapState} from 'vuex'
    import Vue from 'vue';

    Vue.use(Vuex);

    export default {
        props: ['currencies', 'branches', 'total_value','is_admin'],
        data() {
            return {
                items: JSON.parse(this.currencies),
                branch_items: JSON.parse(this.branches),
                currency_id: '',
                branch: '',
                stock_currency: '',
                required: false
            }
        },

        methods: {

            isMM(){
               return this.stock_currency.status === "MMK";
            },

            isSupplierDisabled(item){
                return item.branch_type_id === 2;
            },

            fetch_currency_groups() {
                this.stock_currency = '';
                let currency_type = $('#stock_currency option:selected').val();
                let branch = $('#stock_branch option:selected').val();
                if(this.is_admin){
                    if(currency_type !=='' && branch !==''){
                        this.branch = parseInt(branch);
                        this.currency_id = parseInt(currency_type);
                    }
                }else{
                    if(currency_type !==''){
                        this.branch = null;
                        this.currency_id = parseInt(currency_type);
                    }
                }
                if(this.branch!== '' && this.currency_id!== ''){
                    let data = {
                        currency_id: this.currency_id,
                        to_branch: null,
                        from_branch: this.branch,
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
                            if(data.is_success===false){
                                alert(data.message);
                                window.location.replace('/stock/create_stock');

                            }else{
                                this.stock_currency=data;

                            }
                        });
                }
            },

            handleSubmit() {
                this.required = false;
                let data = {
                    branch: this.branch,
                    currency_id: this.currency_id,
                    groups: this.stock_groups,
                    status: this.stock_currency.status
                };
                for(let groupItem in data.groups){
                    for(let classItem in data.groups[groupItem].class_currency_value){
                        if(isNaN(data.groups[groupItem].class_currency_value[classItem].value)){
                            this.required = true;
                        }
                    }
                    for(let noteItem in data.groups[groupItem].notes){
                        for(let classSheet in data.groups[groupItem].notes[noteItem].class_sheet){
                            if(isNaN(data.groups[groupItem].notes[noteItem].class_sheet[classSheet].sheet)){
                                this.required = true;
                            }
                        }

                    }

                }
                if(this.required){
                    alert('All fileds are required');
                }else{
                    $('#add-btn').append(`
                    <i class="fa fa-spinner fa-spin"></i>
                `).prop('disabled',true);
                    fetch('/stock/add_currency', {
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
                                $("#add-btn").children("i:first").remove();
                                $('#add-btn').prop('disabled',false);

                            }
                        })
                }

            },
        },
        mounted() {
        },
        computed: mapState({
            stock_groups: 'stock_groups'
        }),


    }

</script>
