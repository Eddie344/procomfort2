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
                        <b-form-input type="text" v-model="new_price.category_id" required></b-form-input>
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
                <tbody>
                <tr v-for="(price, index) in prices">
                    <th scope="row">{{ price.category_id }}</th>
                    <td>{{ price.price }}</td>
                    <td>
                        <b-button variant="link" v-b-modal ="'modalDelete'+index"><i class="fa fa-trash-o text-danger"></i></b-button>

                        <b-modal :id="'modalDelete'+index" size="sm" title="Вы уверены?" centered>
                            <template v-slot:modal-footer="{ ok }">
                                <b-button variant="danger" @click="deletePrice(index)">
                                    Удалить
                                </b-button>
                            </template>
                        </b-modal>
                    </td>
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
                dismissSecs: 2,
                dismissCountDown: 0,
                alertColor: null,
                alertText: null,
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
                this.$refs['modalAddPrice'].hide();
                this.showAlert('success', 'Цена успешно добавлена');
            },
            deletePrice(index){
                this.$delete(this.prices, index);
                this.showAlert('danger', 'Цена успешно удалена');
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

</style>
