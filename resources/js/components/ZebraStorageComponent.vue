<template>
    <div>
        <b-row class="mb-3">
            <b-col lg="1">
                <b-button class="mr-3" variant="success" v-b-modal.modalAddPrice>Добавить</b-button>

                <b-modal ref="modalAddPrice" id="modalAddPrice" size="sm" title="Добавление" @hide="resetNewItem" hide-footer centered>
                    <b-form @submit.prevent="addItem">
                        <b-form-group label="Наименование:">
                            <b-form-input type="text" v-model="new_item.label" required></b-form-input>
                        </b-form-group>
                        <b-form-group label="Каталог:">
                            <b-form-select
                                v-model="new_item.catalog_id"
                                :options="catalogs"
                                class="mb-3"
                                value-field="id"
                                text-field="label"
                                @change="getCategories(new_item)"
                                required
                            >
                                <template v-slot:first>
                                    <option :value="null" disabled selected>Выберите каталог...</option>
                                </template>
                            </b-form-select>
                        </b-form-group>
                        <b-form-group label="Категория:" v-if="new_item.catalog_id">
                            <b-form-select
                                v-model="new_item.category_id"
                                :options="categories"
                                class="mb-3"
                                value-field="id"
                                text-field="label"
                            >
                                <template v-slot:first>
                                    <option :value="null" disabled selected>Выберите категорию...</option>
                                </template>
                            </b-form-select>
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

            <b-col lg="5">
                <b-form-group
                    label="Фильтр"
                    label-cols-sm="3"
                    label-align-sm="right"
                    label-for="filterInput"
                    class="mb-0"
                >
                    <b-input-group>
                        <b-form-input
                            v-model="filter"
                            type="search"
                            id="filterInput"
                            placeholder="Введите для поиска..."
                        ></b-form-input>
                        <b-input-group-append>
                            <b-button :disabled="!filter" @click="filter = ''">Очистить</b-button>
                        </b-input-group-append>
                    </b-input-group>
                </b-form-group>
            </b-col>

            <b-col lg="6">
                <b-form-group
                    label="Фильтровать по"
                    label-cols-sm="3"
                    label-align-sm="right"
                    class="mb-0">
                    <b-form-checkbox-group v-model="filterOn" class="mt-1">
                        <b-form-checkbox value="label">Наименование</b-form-checkbox>
                        <b-form-checkbox value="catalog">Каталог</b-form-checkbox>
                        <b-form-checkbox value="category">Категория</b-form-checkbox>
                    </b-form-checkbox-group>
                </b-form-group>
            </b-col>
        </b-row>
        <b-table
            show-empty
            empty-text="Нет записей"
            empty-filtered-text="По данному запросу нет записей"
            id="my-table"
            :items="items"
            :fields="fields"
            :per-page="perPage"
            :current-page="currentPage"
            :striped="true"
            :busy="isBusy"
            :filter="filter"
            :filterIncludedFields="filterOn"
        >
            <template v-slot:cell(label)="data">
                <a :href="'/admin/storage/zebra/'+ data.item.id">{{ data.item.label }}</a>
            </template>
            <template v-slot:cell(catalog)="data">
                {{ data.item.catalog.label }}
            </template>
            <template v-slot:cell(category)="data">
                {{ data.item.category.label }}
            </template>
            <template v-slot:cell(delete)="data">
                <b-button class="p-0" variant="link" @click="deleteModal(data.item.id)"><h5 class="d-inline"><i class="fa fa-trash-o text-danger"></i></h5></b-button>
                <b-button class="p-0" variant="link" @click="editModal(data.item)" ><h5 class="d-inline"><i class="fa fa-pencil text-primary"></i></h5></b-button>
            </template>
            <template v-slot:table-busy>
                <div class="text-center text-primary my-2">
                    <b-spinner class="align-middle"></b-spinner>
                </div>
            </template>
        </b-table>
        <!--Delete modal-->
        <b-modal :id="deletingModal.id" size="sm" title="Вы уверены?" centered>
            <template v-slot:modal-footer="{ ok }">
                <b-button variant="danger" @click="deleteItem" v-bind:disabled="actionLoad">
                    <span v-if="!actionLoad">Удалить</span>
                    <span v-else>
                        <b-spinner small></b-spinner>
                        Подождите...
                    </span>
                </b-button>
            </template>
        </b-modal>
        <!--Edit modal-->
        <b-modal :id="editingModal.id" @hide="resetEditingModal" size="sm" title="Редактирование" hide-footer centered>
            <b-form @submit.prevent="editItem(editingModal.index)">
                <b-form-group label="Наименование:">
                    <b-form-input type="text" v-model="editingModal.label" required></b-form-input>
                </b-form-group>
                <b-form-group label="Каталог:">
                    <b-form-select
                        v-model="editingModal.catalog_id"
                        :options="catalogs"
                        class="mb-3"
                        value-field="id"
                        text-field="label"
                        @change="getCategories(editingModal)"
                        required
                    >
                        <template v-slot:first>
                            <option :value="null" disabled selected>Выберите каталог...</option>
                        </template>
                    </b-form-select>
                </b-form-group>
                <b-form-group label="Категория:">
                    <b-form-select
                        v-model="editingModal.category_id"
                        :options="categories"
                        class="mb-3"
                        value-field="id"
                        text-field="label"
                        required
                    >
                        <template v-slot:first>
                            <option :value="null" disabled selected>Выберите категорию...</option>
                        </template>
                    </b-form-select>
                </b-form-group>
                <b-button variant="primary" type="submit" v-bind:disabled="actionLoad">
                    <span v-if="!actionLoad">Сохранить</span>
                    <span v-else>
                        <b-spinner small></b-spinner>
                        Подождите...
                    </span>
                </b-button>
            </b-form>
        </b-modal>
        <b-row>
            <b-col sm="5" md="6" class="my-1">
                <b-pagination
                    v-model="currentPage"
                    :total-rows="rows"
                    :per-page="perPage"
                    aria-controls="my-table"
                    v-if="!isBusy"
                ></b-pagination>
            </b-col>
            <b-col sm="5" md="6" class="my-1">
                <b-form-group
                    label="Элементов на странице:"
                    label-cols-sm="6"
                    label-cols-md="4"
                    label-cols-lg="6"
                    label-align-sm="right"
                    label-for="perPageSelect"
                    class="mb-0"
                >
                    <b-form-select
                        v-model="perPage"
                        id="perPageSelect"
                        :options="pageOptions"
                    ></b-form-select>
                </b-form-group>
            </b-col>
        </b-row>
    </div>
</template>

<script>
    export default {
        name: "ZebraStorageComponent",
        data() {
            return {
                perPage: 10,
                currentPage: 1,
                fields: [
                    {
                        key: 'label',
                        label: 'Наименование',
                    },
                    {
                        key: 'catalog',
                        label: 'Каталог',
                        sortable: true,
                    },
                    {
                        key: 'category',
                        label: 'Категория',
                        sortable: true
                    },
                    {
                        key: 'delete',
                        label: 'Действия'
                    }
                ],
                items: [],
                categories: [],
                catalogs: [],
                new_item: {
                    catalog_id: null,
                    category_id: null,
                    isFirstOpen: true,
                },
                isBusy: false,
                actionLoad: false,
                pageOptions: [5, 10, 15],
                filter: null,
                filterOn: [],
                deletingModal: {
                    id: 'delMod',
                    item_id: null,
                },
                editingModal: {
                    id: 'edMod',
                    item_id: null,
                    label: '',
                    catalog_id: null,
                    category_id: null,
                    isFirstOpen: true,
                }
            }
        },
        computed: {
            rows() {
                return this.items.length
            },
            sortOptions() {
                // Create an options list from our fields
                return this.fields
                    .filter(f => f.sortable)
                    .map(f => {
                        return { text: f.label, value: f.key }
                    })
            }
        },
        mounted() {
            this.getCatalogs();
            this.load();
        },
        methods:{
            load(){
                this.isBusy = true;
                axios.post('/admin/storage/zebra/getAll')
                    .then((response) => {
                        this.items = response.data;
                        this.isBusy = false;
                    });
            },
            addItem(){
                this.actionLoad = true;
                axios.post('/admin/storage/zebra', {
                    item: this.new_item
                })
                    .then((response) => {
                        this.load();
                        this.actionLoad = false;
                        this.$refs['modalAddPrice'].hide();
                        this.makeToast('Предмет успешно добавлен', 'success');
                    });
            },
            editItem() {
                this.actionLoad = true;
                axios.put('/admin/storage/zebra/'+this.editingModal.item_id, {
                    item: {
                        label: this.editingModal.label,
                        catalog_id: this.editingModal.catalog_id,
                        category_id: this.editingModal.category_id,
                    }
                })
                    .then((response) => {
                        this.load();
                        this.actionLoad = false;
                        this.$bvModal.hide(this.editingModal.id);
                        this.makeToast('Предмет успешно изменен', 'primary');
                    });
            },
            deleteItem(){
                this.actionLoad = true;
                axios.delete('/admin/storage/zebra/'+this.deletingModal.item_id)
                    .then((response) => {
                        this.load();
                        this.actionLoad = false;
                        this.$bvModal.hide(this.deletingModal.id);
                        this.deletingModal.index = null;
                        this.makeToast('Предмет успешно удален', 'danger');
                    });
            },
            deleteModal(id) {
                this.deletingModal.item_id = id;
                this.$root.$emit('bv::show::modal', this.deletingModal.id);
            },
            editModal(item) {
                this.editingModal.item_id = item.id;
                this.editingModal.label = item.label;
                this.editingModal.catalog_id = item.catalog_id;
                this.editingModal.category_id = item.category_id;
                this.getCategories(this.editingModal);
                this.$root.$emit('bv::show::modal', this.editingModal.id);
            },
            resetEditingModal() {
                this.editingModal.item_id = null;
                this.editingModal.label = '';
                this.editingModal.catalog_id = null;
                this.editingModal.category_id = null;
                this.editingModal.isFirstOpen = true;
            },
            resetNewItem() {
                this.new_item.label = '';
                this.new_item.catalog_id = null;
                this.new_item.category_id = null;
                this.new_item.isFirstOpen = true;
            },
            getCategories(modal_type){
                axios.post('/admin/other/categories/zebra/get', {
                    catalog_id: modal_type.catalog_id
                })
                    .then((response) => {
                        this.categories = response.data;
                        //Фикс обнуления категории при первом открытии в editingModal
                        if(modal_type.isFirstOpen === false) modal_type.category_id = null;
                        modal_type.isFirstOpen = false;
                    });
            },
            getCatalogs(){
                axios.post('/admin/other/catalogs/get')
                    .then((response) => {
                        this.catalogs = response.data;
                    });
            },
            onFiltered(filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length;
                this.currentPage = 1;
            },
            makeToast(message, color) {
                this.$bvToast.toast(message, {
                    title: 'Уведомление',
                    autoHideDelay: 3000,
                    variant: color,
                    appendToast: false,
                    toaster: 'b-toaster-top-right',
                })
            }
        }
    }
</script>

<style scoped>

</style>
