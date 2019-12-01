<template>
    <div>
        <h2 class="mb-4">Ткани рулонные > L-0880</h2>
        <b-card no-body>
            <b-tabs card>
                <b-tab title="Общая информация" active>
                    <b-card-text>
                        <dl class="row">
                            <dt class="col-sm-6">Наименование:</dt>
                            <dd class="col-sm-6"><h4>{{ item.label }}</h4></dd>

                            <dt class="col-sm-6">Каталог:</dt>
                            <dd class="col-sm-6">{{ item.catalog.label }}</dd>

                            <dt class="col-sm-6">Категория:</dt>
                            <dd class="col-sm-6">{{ item.category.label }}</dd>

                            <dt class="col-sm-6">Направление рисунка:</dt>
                            <dd class="col-sm-6">{{ item.picture.label }}</dd>

                        </dl>
                    </b-card-text>
                </b-tab>
                <b-tab title="Партии и остатки">
                    <b-card-text>
                        <b-row class="mb-3">
                            <b-col lg="1">
                                <b-button class="mr-3" variant="success" v-b-modal.modalAddPart>Добавить</b-button>

                                <b-modal ref="modalAddPart" id="modalAddPart" size="sm" title="Добавление" hide-footer centered>
                                    <b-form @submit.prevent="addPart">
                                        <b-form-group label="Тип:">
                                            <b-form-select
                                                v-model="new_part.type_id"
                                                :options="part_types"
                                                class="mb-3"
                                                value-field="id"
                                                text-field="label"
                                            >
                                                <template v-slot:first>
                                                    <option :value="null" disabled selected>Выберите тип...</option>
                                                </template>
                                            </b-form-select>
                                        </b-form-group>
                                        <b-form-group label="Поставщик:">
                                            <b-form-select
                                                v-model="new_part.provider_id"
                                                :options="providers"
                                                class="mb-3"
                                                value-field="id"
                                                text-field="label"
                                            >
                                                <template v-slot:first>
                                                    <option :value="null" disabled selected>Выберите поставщика...</option>
                                                </template>
                                            </b-form-select>
                                        </b-form-group>
                                        <b-form-group label="Ширина:">
                                            <b-form-input type="number" step="0.01" v-model="new_part.width" required></b-form-input>
                                        </b-form-group>
                                        <b-form-group label="Длина:">
                                            <b-form-input type="number" step="0.01" v-model="new_part.lenght" required></b-form-input>
                                        </b-form-group>
                                        <b-form-group label="Цена:">
                                            <b-form-input type="number" step="0.01" v-model="new_part.price" required></b-form-input>
                                        </b-form-group>
                                        <b-form-group label="Статус:">
                                            <b-form-select
                                                v-model="new_part.status_id"
                                                :options="part_statuses"
                                                class="mb-3"
                                                value-field="id"
                                                text-field="label"
                                            >
                                                <template v-slot:first>
                                                    <option :value="null" disabled selected>Выберите статус...</option>
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
                                        <b-form-checkbox value="picture">Направление рисунка</b-form-checkbox>
                                    </b-form-checkbox-group>
                                </b-form-group>
                            </b-col>
                        </b-row>
                        <b-table
                            show-empty
                            empty-text="Нет записей"
                            empty-filtered-text="По данному запросу нет записей"
                            id="my-table"
                            :items="parts"
                            :fields="parts_fields"
                            :per-page="perPage"
                            :current-page="currentPage"
                            :striped="true"
                            :busy="isBusy"
                            :filter="filter"
                            :filterIncludedFields="filterOn"
                        >
                            <template v-slot:cell(provider)="data">
                                {{ data.item.provider.label }}
                            </template>
                            <template v-slot:cell(status)="data">
                                {{ data.item.status.label }}
                            </template>
                            <template v-slot:cell(type)="data">
                                {{ data.item.type.label }}
                            </template>
                            <template v-slot:cell(delete)="data">
                                <b-button class="p-0" variant="link" @click="deleteModal(data.index)"><h5 class="d-inline"><i class="fa fa-trash-o text-danger"></i></h5></b-button>
                                <b-button class="p-0" variant="link" @click="editModal(data.index, data.item)" ><h5 class="d-inline"><i class="fa fa-pencil text-primary"></i></h5></b-button>
                            </template>
                            <template v-slot:table-busy>
                                <div class="text-center text-primary my-2">
                                    <b-spinner class="align-middle"></b-spinner>
                                </div>
                            </template>
                        </b-table>
                    </b-card-text>
                </b-tab>
                <b-tab title="Операции">
                    <b-card-text>Tab contents 2</b-card-text>
                </b-tab>
            </b-tabs>
        </b-card>
    </div>
</template>

<script>
    export default {
        name: "RollStorageSingleComponent",
        props:['id'],
        data() {
            return {
                perPage: 10,
                currentPage: 1,
                isBusy: false,
                actionLoad: false,
                pageOptions: [5, 10, 15],
                filter: null,
                filterOn: [],
                parts_fields: [
                    {
                        key: 'width',
                        label: 'Ширина',
                        sortable: true,
                    },
                    {
                        key: 'lenght',
                        label: 'Длина',
                        sortable: true,
                    },
                    {
                        key: 'price',
                        label: 'Категория',
                        sortable: true
                    },
                    {
                        key: 'provider',
                        label: 'Поставщик',
                        sortable: true
                    },
                    {
                        key: 'status',
                        label: 'Статус',
                        sortable: true
                    },
                    {
                        key: 'type',
                        label: 'Тип',
                        sortable: true
                    },
                    {
                        key: 'delete',
                        label: 'Действия'
                    }
                ],
                item: {},
                parts: [],
                new_part: {
                    roll_storage_id: this.id
                },
                providers: [],
                part_statuses: [],
                part_types: [],
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
            this.loadItem();
            this.loadParts();
            this.getPartStatuses();
            this.getPartTypes();
            this.getProviders();
        },
        methods: {
            loadItem() {
                axios.post('/admin/storage/roll/get/'+this.id)
                    .then((response) => {
                        this.item = response.data;
                    })
            },
            loadParts() {
                axios.post('/admin/storage/roll_parts/getAll', {
                    roll_storage_id: this.id
                })
                    .then((response) => {
                        console.log(response.data);
                        this.parts = response.data;
                    })
            },
            addPart(){
                this.actionLoad = true;
                axios.post('/admin/storage/roll_parts', {
                    part: this.new_part,
                })
                    .then((response) => {
                        this.parts.push(response.data);
                        this.new_part = {};
                        this.actionLoad = false;
                        this.$refs['modalAddPart'].hide();
                    });
            },
            getPartTypes(){
                axios.post('/admin/other/part_types/get')
                    .then((response) => {
                        this.part_types = response.data;
                    });
            },
            getPartStatuses(){
                axios.post('/admin/other/part_statuses/get')
                    .then((response) => {
                        this.part_statuses = response.data;
                    });
            },
            getProviders(){
                axios.post('/admin/other/providers/get')
                    .then((response) => {
                        this.providers = response.data;
                    });
            },
            onFiltered(filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length;
                this.currentPage = 1;
            }
        }
    }
</script>

<style scoped>

</style>
