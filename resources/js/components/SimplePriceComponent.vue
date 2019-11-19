<template>
    <div>
        <b-form inline class="mb-3">
            <b-form-select class="mr-3" v-model="catalog_selected" @change="load">
                <option :value="null" disabled selected>Выберите каталог...</option>
                <option v-for="c in catalogs" v-bind:value="c.id">{{ c.label }}</option>
            </b-form-select>
            <b-spinner class="mr-3" small label="Loading..." variant="info" v-if="loading"></b-spinner>
            <b-button class="mr-3" variant="success" v-b-modal.modal-add-price v-if="tableLoaded && !loading"><strong>+</strong></b-button>

            <b-modal id="modal-add-price" title="Добавление цены">
                <p class="my-4">Hello from modal!</p>
            </b-modal>
        </b-form>
<!--        <div class="mb-3 form-inline">-->
<!--            <select class="form-control" v-model="catalog_selected" v-on:change="load">-->
<!--                <option :value="null" disabled selected>Выберите каталог...</option>-->
<!--                <option v-for="c in catalogs" v-bind:value="c.id">{{ c.label }}</option>-->
<!--            </select>-->
<!--            <div class="spinner-border spinner-border-sm ml-3" role="status" v-if="loading">-->
<!--                <span class="sr-only">Loading...</span>-->
<!--            </div>-->
<!--            <b-button variant="success" pill v-b-modal.modal-add-price v-if="tableLoaded"><strong>+</strong></b-button>-->

<!--            <b-modal id="modal-add-price" title="Добавление цены">-->
<!--                <p class="my-4">Hello from modal!</p>-->
<!--            </b-modal>-->
<!--        </div>-->
        <!-- Add modal -->
        <div class="modal fade" id="add-part" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <form @submit.prevent="addPrice">
                        <div class="modal-header">
                            <h5 class="modal-title">Добавление цены</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="new-category">Категория:</label>
                                <input type="text" class="form-control" id="new-category" required v-model="new_price.category_id">
                            </div>
                            <div class="form-group">
                                <label for="new-price">Цена:</label>
                                <input type="number" class="form-control" id="new-price" required v-model="new_price.price">
                            </div>
                            <div class="form-group" v-if="errors.length">
                                <ul class="alert alert-danger" role="alert">
                                    <li v-for="error in errors">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div v-show="tableLoaded">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Категория</th>
                        <th scope="col">Цена за м<sup>2</sup></th>
                        <th scope="col">Действия</th>
                    </tr>
                </thead>
                <tbody>
                <tr v-for="(price, index) in prices">
                    <th scope="row">{{ price.category_id }}</th>
                    <td>{{ price.price }}</td>
                    <td><a href="" data-toggle="modal" data-target="#modalDelete"><h5 class="d-inline"><i class="fa fa-trash-o text-danger"></i></h5></a></td>
                    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Вы уверены?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="deletePrice(index)">Удалить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SimplePriceComponent",
        props:[
            'type'
        ],
        data: function () {
            return {
                catalog_selected: null,
                catalogs: [],
                prices: [],
                loading: false,
                tableLoaded: false,
                new_price: {},
                errors: [],
            }
        },
        mounted(){
            this.getCatalogs();
        },
        methods:{
            getCatalogs(){
                axios.post('/admin/other/catalogs/get')
                    .then((response) => {
                        this.catalogs = response.data;
                    });
            },
            load(){
                this.loading = true;
                axios.post('/admin/price/'+this.type+'/get', {
                    catalog_id: this.catalog_selected,
                })
                    .then((response) => {
                        this.prices = response.data;
                        this.loading = false;
                        this.tableLoaded = true;
                    });
            },
            addPrice(){
                this.prices.push(this.new_price);
                this.new_price = {};
            },
            deletePrice(index){
                this.$delete(this.prices, index);
            },
        },
    }
</script>

<style scoped>

</style>
