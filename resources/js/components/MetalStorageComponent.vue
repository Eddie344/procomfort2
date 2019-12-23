<template>
    <div>
        <b-row class="mb-3">
            <b-col lg="1">
                <b-button class="mr-3" variant="success" v-b-modal.modalAddPrice>Добавить</b-button>

                <b-modal ref="modalAddPrice" id="modalAddPrice" size="sm" title="Добавление" hide-footer centered>
                    <b-form @submit.prevent="addItem">
                        <b-form-group label="Наименование:">
                            <b-form-input type="text" v-model="new_item.label" required></b-form-input>
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
                <a :href="'/admin/storage/metal/'+ data.item.id">{{ data.item.label }}</a>
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
            <b-form @submit.prevent="editItem">
                <b-form-group label="Наименование:">
                    <b-form-input type="text" v-model="editingModal.label" required></b-form-input>
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
        name: "MetalStorageComponent",
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
                        key: 'delete',
                        label: 'Действия'
                    }
                ],
                items: [],
                new_item: {},
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
            this.load();
        },
        methods:{
            load(){
                this.isBusy = true;
                axios.post('/admin/storage/metal/getAll')
                    .then((response) => {
                        this.items = response.data;
                        this.isBusy = false;
                    });
            },
            addItem(){
                this.actionLoad = true;
                axios.post('/admin/storage/metal', {
                    item: this.new_item
                })
                    .then((response) => {
                        this.load();
                        this.new_item = {};
                        this.actionLoad = false;
                        this.$refs['modalAddPrice'].hide();
                        this.makeToast('Предмет успешно добавлен', 'success');
                    });
            },
            editItem() {
                this.actionLoad = true;
                axios.put('/admin/storage/metal/'+this.editingModal.item_id, {
                    item: {
                        label: this.editingModal.label,
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
                axios.delete('/admin/storage/metal/'+this.deletingModal.item_id)
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
                this.$root.$emit('bv::show::modal', this.editingModal.id);
            },
            resetEditingModal() {
                this.editingModal.item_id = null;
                this.editingModal.label = '';
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
