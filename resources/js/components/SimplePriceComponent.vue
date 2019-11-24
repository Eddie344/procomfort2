<template>
    <div>
        <b-form inline class="mb-3">
            <b-form-select class="mr-3" v-model="catalog_selected" @change="load">
                <option :value="null" disabled selected>Выберите каталог...</option>
                <option v-for="c in catalogs" v-bind:value="c.id">{{ c.label }}</option>
            </b-form-select>
            <b-spinner class="mr-3" small label="Loading..." variant="info" v-if="loading"></b-spinner>
            <b-button class="mr-3" variant="success" v-b-modal.modalAddPrice v-if="tableLoaded && !loading"><strong>+</strong></b-button>

            <b-modal ref="modalAddPrice" id="modalAddPrice" size="sm" title="Добавление цены" hide-footer centered>
                <b-form @submit.prevent="addPrice">
                    <b-form-group label="Категория:">
                        <b-form-input type="number" :state="validation" v-model="new_price.category_id" required></b-form-input>
                        <b-form-invalid-feedback :state="validation">
                            Укажите уникальную категорию
                        </b-form-invalid-feedback>
                    </b-form-group>
                    <b-form-group label="Цена:">
                        <b-form-input type="number" v-model="new_price.price" required></b-form-input>
                    </b-form-group>
                    <b-button variant="primary" type="submit">Добавить</b-button>
                </b-form>
            </b-modal>
        </b-form>
        <b-alert
            :show="dismissCountDown"
            dismissible
            :variant="alertColor"
            @dismissed="dismissCountDown=0"
            @dismiss-count-down="countDownChanged"
        >
            {{ alertText }}
        </b-alert>
        <div v-show="tableLoaded">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Категория</th>
                        <th scope="col">Цена за м<sup>2</sup></th>
                        <th scope="col">Действия</th>
                    </tr>
                </thead>

                        <transition-group name="row-fade" tag="tbody">
                        <tr v-for="(price, index) in prices" v-bind:key="price.id">
                            <th scope="row">{{ price.category_id }}</th>
                            <td>{{ price.price }}</td>
                            <td>
                                <b-button class="p-0" variant="link" v-b-modal ="'modalDeletePrice'+price.id"><h5 class="d-inline"><i class="fa fa-trash-o text-danger"></i></h5></b-button>

                                <b-modal ref="modalDeletePrice" :id="'modalDeletePrice'+price.id" size="sm" title="Вы уверены?" centered>
                                    <template v-slot:modal-footer="{ ok }">
                                        <b-button variant="danger" @click="deletePrice(index, price.id)">
                                            Удалить
                                        </b-button>
                                    </template>
                                </b-modal>
                            </td>
                        </tr>
                        </transition-group>

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
                new_price: {
                    catalog_id: this.catalog_selected,
                },
                errors: [],
                dismissSecs: 2,
                dismissCountDown: 0,
                alertColor: null,
                alertText: null,
            }
        },
        mounted(){
            this.getCatalogs();
        },
        computed: {
            validation() {
                return !this.prices.some(i =>  i.category_id === this.new_price.category_id);
            }
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
                        console.log(response.data);
                        this.prices = response.data;
                        this.loading = false;
                        this.tableLoaded = true;
                    });
            },
            addPrice(){
                let error = this.prices.some(i =>  i.category_id === this.new_price.category_id);
                if(!error){
                    axios.post('/admin/price/'+this.type, {
                        catalog_id: this.catalog_selected,
                        category_id: this.new_price.category_id,
                        price: this.new_price.price,
                    })
                        .then((response) => {
                            console.log(response.data);
                            this.new_price.id = response.data;
                            this.prices.push(this.new_price);
                            this.new_price = {};
                        });
                    //this.showAlert('success', 'Цена успешно добавлена');
                    this.$refs['modalAddPrice'].hide();
                }
            },
            deletePrice(index, id){
                axios.delete('/admin/price/'+this.type+'/'+id)
                    .then((response) => {
                        console.log(response.data);
                        this.$delete(this.prices, index);
                        //this.showAlert('danger', 'Цена успешно удалена');
                    });
                this.$bvModal.hide('modalDeletePrice'+id);
            },
            countDownChanged(dismissCountDown) {
                this.dismissCountDown = dismissCountDown
            },
            showAlert(color, text) {
                this.alertColor = color;
                this.alertText = text;
                this.dismissCountDown = this.dismissSecs
            }
        },
    }
</script>

<style scoped>
    .row-fade-enter-active {
        transition: all .3s ease;
    }
    .row-fade-leave-active {
        transition: all .8s ease;
    }
    .row-fade-enter, .row-fade-leave-to
        /* .slide-fade-leave-active до версии 2.1.8 */ {
        transform: translateX(10px);
        opacity: 0;
    }
</style>
