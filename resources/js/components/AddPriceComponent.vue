<template>
    <div>
        <b-form inline class="mb-3">
            <b-form-select class="mr-3" v-model="product_type_selected" @change="load">
                <option :value="null" disabled selected>Выберите тип изделия...</option>
                <option v-for="p in product_types" v-bind:value="p.id">{{ p.label }}</option>
            </b-form-select>
            <b-spinner class="mr-3" small label="Loading..." variant="info" v-if="loading"></b-spinner>
            <b-button class="mr-3" variant="success" v-b-modal.modalAddPrice v-if="tableLoaded && !loading"><strong>+</strong></b-button>

            <b-modal ref="modalAddPrice" id="modalAddPrice" size="sm" title="Добавление" hide-footer centered>
                <b-form @submit.prevent="addPrice">
                    <b-form-group label="Наименование:">
                        <b-form-input type="text" v-model="new_price.label" required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Цена:">
                        <b-form-input type="number" v-model="new_price.price" required></b-form-input>
                    </b-form-group>
                    <b-button variant="primary" type="submit">Добавить</b-button>
                </b-form>
            </b-modal>
        </b-form>
        <div v-show="tableLoaded">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Наименование</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <transition-group name="row-fade" tag="tbody" mode="out-in">
                    <caption v-show="!Object.keys(prices).length" key="empty">Таблица пуста</caption>
                    <tr v-for="(price, index) in prices" v-bind:key="price.id">
                        <td>{{ price.label }}</td>
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

                            <b-button class="p-0" variant="link" v-b-modal ="'modalEditPrice'+price.id"><h5 class="d-inline"><i class="fa fa-pencil text-primary"></i></h5></b-button>
                            <b-modal ref="modalEditPrice" :id="'modalEditPrice'+price.id" size="sm" title="Редактирование" hide-footer centered>
                                <b-form @submit.prevent="editPrice(price.id, index)">
                                    <b-form-group label="Наименование:">
                                        <b-form-input type="text" v-model="price.label" readonly></b-form-input>
                                    </b-form-group>
                                    <b-form-group label="Цена:">
                                        <b-form-input type="number" v-model="price.price" required></b-form-input>
                                    </b-form-group>
                                    <b-button variant="primary" type="submit">Сохранить</b-button>
                                </b-form>
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
        name: "AddPriceComponent",
        data: function () {
            return {
                product_type_selected: null,
                product_types: {},
                loading: false,
                tableLoaded: false,
                prices: {},
                new_price: {},
            }
        },
        mounted(){
            this.getProductTypes();
        },
        methods:{
            getProductTypes(){
                axios.post('/admin/other/product_types/get')
                    .then((response) => {
                        this.product_types = response.data;
                    });
            },
            load(){
                this.loading = true;
                axios.post('/admin/price/add/get', {
                    product_type_id: this.product_type_selected,
                })
                    .then((response) => {
                        console.log(response.data);
                        this.prices = response.data;
                        this.loading = false;
                        this.tableLoaded = true;
                    });
            },
            addPrice(){
                axios.post('/admin/price/add', {
                    product_type_id: this.product_type_selected,
                    label: this.new_price.label,
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
            },
            editPrice(id, index){
                axios.put('/admin/price/add/'+id, {
                    price: this.prices[index].price,
                })
                    .then((response) => {
                        console.log(response.data);
                        this.load();
                    });
                //this.showAlert('success', 'Цена успешно добавлена');
                this.$bvModal.hide('modalEditPrice'+id);
            },
            deletePrice(index, id){
                axios.delete('/admin/price/add/'+id)
                    .then((response) => {
                        console.log(response.data);
                        this.$delete(this.prices, index);
                        //this.showAlert('danger', 'Цена успешно удалена');
                    });
                this.$bvModal.hide('modalDeletePrice'+id);
            },
        }
    }
</script>

<style scoped lang="sass">
    .row-fade-enter-active
        transition: all .3s ease
    .row-fade-leave-active
        transition: all .3s ease
    .row-fade-enter, .row-fade-leave-to
        /* .slide-fade-leave-active до версии 2.1.8 */
        transform: translateX(10px)
        opacity: 0
</style>
