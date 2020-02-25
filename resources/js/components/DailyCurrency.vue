<template>
    <div class="container-nb-mount">

        <div class="">
            <div class="border-bottom-radius-mount ">
                <div
                    class="mb-0 pt-4 pb-4 px-2 d-flex justify-content-between fs-select bg-white border-bottom-radius-mount box-shadow-mount2">
                    <select class="selectpicker ml-4 pl-2 " name="currency" data-width="auto"
                            v-on:change="fetch_currency_groups()"
                            id="currency_filter">
                        <option selected disabled style="background-color: #e8e8e8;">Currency</option>
                        <option :value="item.id"
                                v-for="item in items">{{item.name}}
                        </option>
                    </select>
                    <button v-on:click="submitForm()" class="btn btn-nb-mount px-4 my-auto mr-5 fontsize-mount2" id="daily-currency-save-btn">Add
                    </button>
                </div>
                <div class="container bg-white rounded-table-mount box-shadow-mount pr-4" id="daily"
                     style="margin-top: 2.3rem">
                    <group-value v-if="groups" :data="groups" :currency_id="currency_id" :isUs="isUs()"></group-value>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Vuex, {mapState} from 'vuex'
    import Vue from 'vue';

    Vue.use(Vuex);

    export default {
        props: ['currencies'],
        data() {
            return {
                items: JSON.parse(this.currencies),
                groups: '',
                currency_id: '',
                required: false
            }
        },

        methods: {

            isUs() {
                return this.groups.currency_type === 'us_currency';
            },

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
                        if(data.is_success===false){
                            alert(data.message);
                            window.location.replace('/daily_currency/create');
                        }else{
                            this.groups = data;
                        }
                    });
            },

            submitForm() {
                this.required = false;
                for(let groupItem in this.daily_currency_data.daily_value){
                    for(let classItem in this.daily_currency_data.daily_value[groupItem].class_group_value){
                        if(this.daily_currency_data.daily_value[groupItem].class_group_value[classItem].value === ""){
                            this.required = true;
                        }
                    }
                }
                if(this.required){
                    alert('All fields are required!')
                }else{
                    $('#daily-currency-save-btn').append(`
                    <i class="fa fa-spinner fa-spin"></i>
                `).prop('disabled',true);
                    fetch('/daily_currency/store', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        body: JSON.stringify(this.daily_currency_data)
                    })
                        .then(response => response.json())
                        .then(data => {
                            if(data.is_success){
                                window.location.replace('/daily_currency');
                            }else{
                                $("#daily-currency-save-btn").children("i:first").remove();
                                $('#daily-currency-save-btn').prop('disabled',false);
                                alert(data.message)
                            }
                        });
                }

            },
        },
        mounted() {

        },
        computed: mapState({
            daily_currency_data: 'daily_currency_data'
        }),


    }

</script>
