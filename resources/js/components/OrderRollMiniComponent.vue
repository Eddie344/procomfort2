<template>
    <div>
        <b-row class="mb-3">
            <b-col lg="1">
                <b-button variant="success" v-b-modal.modalAdd>Добавить</b-button>
                <b-modal ref="modalAdd" id="modalAdd" size="sm" title="Добавление" hide-footer centered>
                    <b-form @submit.prevent="addOrder">
                        <b-form-group label="Ширина:">
                            <b-form-input type="number" min="0.1" step="0.01" v-model="new_product.width" required></b-form-input>
                        </b-form-group>
                        <b-form-group label="Высота:">
                            <b-form-input type="number" min="0.1" step="0.01" v-model="new_product.height" required></b-form-input>
                        </b-form-group>
                        <b-form-group label="Управление:">
                            <b-form-select
                                v-model="new_product.rule_type_id"
                                :options="rule_types"
                                class="mb-3"
                                value-field="id"
                                text-field="label"
                                required
                            >
                                <template v-slot:first>
                                    <option :value="null" disabled selected>Выберите тип управления...</option>
                                </template>
                            </b-form-select>
                        </b-form-group>
                        <b-form-group label="Длина управления:">
                            <b-form-input type="number" step="0.01" v-model="newRuleLenght" required></b-form-input>
                        </b-form-group>
                        <b-form-group label="Комплектация:">
                            <b-form-select
                                v-model="new_product.complectation_type_id"
                                :options="complectation_types"
                                class="mb-3"
                                value-field="id"
                                text-field="label"
                                required
                            >
                                <template v-slot:first>
                                    <option :value="null" disabled selected>Выберите тип комплектации...</option>
                                </template>
                            </b-form-select>
                        </b-form-group>
                        <b-form-group label="Ткань:">
                            <b-form-select
                                v-model="new_product.material_id"
                                :options="materials"
                                class="mb-3"
                                value-field="id"
                                text-field="label"
                                required
                            >
                                <template v-slot:first>
                                    <option :value="null" disabled selected>Выберите ткань...</option>
                                </template>
                            </b-form-select>
                        </b-form-group>
                        <b-form-group label="Цвет фурнитуры:">
                            <b-form-select
                                v-model="new_product.furn_color_id"
                                :options="furn_colors"
                                class="mb-3"
                                value-field="id"
                                text-field="label"
                                required
                            >
                                <template v-slot:first>
                                    <option :value="null" disabled selected>Выберите цвет фурнитуры...</option>
                                </template>
                            </b-form-select>
                        </b-form-group>
                        <b-form-group>
                            <b-form-checkbox
                                id="checkbox-1"
                                v-model="new_product.chain_lock"
                                name="checkbox-1"
                                value="accepted"
                                unchecked-value="not_accepted"
                                required
                            >
                                Фиксатор цепи
                            </b-form-checkbox>
                            <b-form-checkbox
                                id="checkbox-2"
                                v-model="new_product.chain_tensioner"
                                name="checkbox-1"
                                value="accepted"
                                unchecked-value="not_accepted"
                                required
                            >
                                Натяжитель цепи
                            </b-form-checkbox>
                            <b-form-checkbox
                                id="checkbox-3"
                                v-model="new_product.fishing_line"
                                name="checkbox-1"
                                value="accepted"
                                unchecked-value="not_accepted"
                                required
                            >
                                Леска
                            </b-form-checkbox>
                            <b-form-checkbox
                                id="checkbox-4"
                                v-model="new_product.magnets"
                                name="checkbox-1"
                                value="accepted"
                                unchecked-value="not_accepted"
                                required
                            >
                                Магниты
                            </b-form-checkbox>
                            <b-form-checkbox
                                id="checkbox-5"
                                v-model="new_product.without_drilling"
                                name="checkbox-1"
                                value="accepted"
                                unchecked-value="not_accepted"
                                required
                            >
                                Крепление без сверления
                            </b-form-checkbox>
                        </b-form-group>
                        <b-form-group label="Количество изделий:">
                            <b-form-input min="1" type="number" v-model="new_product.count" required></b-form-input>
                        </b-form-group>
                        <b-form-group label="Примечание:">
                            <b-form-textarea v-model="new_product.note"></b-form-textarea>
                        </b-form-group>
                        <b-button variant="primary" type="submit" v-bind:disabled="actionLoad">
                            <span v-if="!actionLoad">Добавить</span>
                            <span v-else>
                                <b-spinner small></b-spinner>
                                Подождите...
                            </span>
                        </b-button>
                    </b-form>
                </b-modal>
            </b-col>
        </b-row>
        <b-table
            show-empty
            empty-text="Нет записей"
            empty-filtered-text="По данному запросу нет записей"
            id="my-table"
            :items="products"
            :fields="fields"
            :per-page="perPage"
            :current-page="currentPage"
            :striped="true"
            :busy="isBusy"
            sort-by="created_at"
            sort-desc
        >
        </b-table>
    </div>
</template>

<script>
    export default {
        name: "OrderRollMiniComponent",
        data() {
            return {
                perPage: 10,
                currentPage: 1,
                isBusy: false,
                actionLoad: false,
                fields: [
                    {
                        key: 'width',
                        label: 'Ширина',
                        sortable: true,
                    },
                    {
                        key: 'height',
                        label: 'Высота',
                        sortable: true,
                    },
                    {
                        key: 'rule.label',
                        label: 'Управление',
                        sortable: true,
                    },
                    {
                        key: 'rule_lenght',
                        label: 'Длина управления',
                        sortable: true,
                    },
                    {
                        key: 'complectation.label',
                        label: 'Комплектация',
                        sortable: true,
                    },
                    {
                        key: 'material.label',
                        label: 'Ткань',
                        sortable: true,
                    },
                    {
                        key: 'delete',
                        label: 'Действия'
                    }
                ],
                new_product: {
                    rule_lenght: null,
                    rule_type_id: null,
                    complectation_type_id: null,
                    material_id: null,
                    furn_color_id: null,
                    chain_lock: false,
                    chain_tensioner: false,
                    fishing_line: false,
                    magnets: false,
                    without_drilling: false,
                    count: 1,
                    note: '',
                },
                products: [],
                rule_types: [],
                materials: [],
                complectation_types: [],
                furn_colors: [],

            }
        },
        mounted() {
            this.loadProducts();
            this.loadMaterials();
            this.loadRules();
            this.loadComplectations();
            this.loadFurnColors();
        },
        computed: {
            newRuleLenght: function() {
                return  this.new_product.rule_lenght = this.new_product.height;
            }
        },
        methods: {
            loadProducts(){
                this.isBusy = true;
                axios.post('/admin/products/getAll')
                    .then((response) => {
                        this.products = response.data;
                        this.isBusy = false;
                    });
            },
            loadMaterials(){
                axios.post('/admin/storage/roll/getAll')
                    .then((response) => {
                        this.materials = response.data;
                    });
            },
            loadRules(){
                axios.post('/admin/other/rule_types/get')
                    .then((response) => {
                        this.rule_types = response.data;
                        this.rule_types.splice(2,1);
                    });
            },
            loadComplectations(){
                axios.post('/admin/other/complectations_types/get')
                    .then((response) => {
                        this.complectation_types = response.data;
                    });
            },
            loadFurnColors(){
                axios.post('/admin/other/furn_colors/get')
                    .then((response) => {
                        this.furn_colors = response.data;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
