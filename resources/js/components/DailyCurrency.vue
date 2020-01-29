<template>
    <div class="container-nb-mount">

        <div class="">
            <form>
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
                        <button type="submit" class="btn btn-nb-mount px-4 my-auto mr-5 fontsize-mount2"> Add
                        </button>
                    </div>
                    <div class="container bg-white rounded-table-mount box-shadow-mount pr-4" id="daily"
                         style="margin-top: 2.3rem">
                        <group-value v-if="groups" :data="groups" :currency_id="currency_id" :isUs="isUs()"></group-value>
                    </div>

                </div>
            </form>


        </div>
    </div>
</template>
<script>

    export default {
        props: ['currencies'],
        data() {
            return {
                items: JSON.parse(this.currencies),
                groups: '',
                currency_id: ''

            }
        },

        methods: {


            isUs(){
                return this.groups.currency_type === 'us_currency';
            },

            fetch_currency_groups() {
                this.groups='';
                // let currency_id;
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
                        this.groups= data.results;
                    });
            }
        },
        mounted() {

        },



    }

</script>
