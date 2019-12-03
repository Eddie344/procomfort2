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
                                        <b-form-group label="Причина:">
                                            <b-form-input type="text" v-model="new_part.reason" required></b-form-input>
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
                                    label-for="partsFilterInput"
                                    class="mb-0"
                                >
                                    <b-input-group>
                                        <b-form-input
                                            v-model="partsFilter"
                                            type="search"
                                            id="partsFilterInput"
                                            placeholder="Введите для поиска..."
                                        ></b-form-input>
                                        <b-input-group-append>
                                            <b-button :disabled="!partsFilter" @click="partsFilter = ''">Очистить</b-button>
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
                                    <b-form-checkbox-group v-model="partsFilterOn" class="mt-1">
                                        <b-form-checkbox value="type">Тип</b-form-checkbox>
                                        <b-form-checkbox value="provider">Поставщик</b-form-checkbox>
                                        <b-form-checkbox value="status">Статус</b-form-checkbox>
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
                            :per-page="partsPerPage"
                            :current-page="partsCurrentPage"
                            :striped="true"
                            :busy="partsIsBusy"
                            :filter="partsFilter"
                            :filterIncludedFields="partsFilterOn"
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
                                <b-button class="p-0" variant="link" @click="editModal(data.index, data.item)" ><h5 class="d-inline"><i class="fa fa-arrow-down text-secondary"></i></h5></b-button>
                            </template>
                            <template v-slot:table-busy>
                                <div class="text-center text-primary my-2">
                                    <b-spinner class="align-middle"></b-spinner>
                                </div>
                            </template>
                        </b-table>
                        <!--Delete modal-->
                        <b-modal :id="deletingModal.id" @hide="deletingModal.reason = ''" size="sm" title="Удаление" hide-footer centered>
                            <b-form @submit.prevent="deletePart(deletingModal.index)">
                                <b-form-group label="Причина:">
                                    <b-form-input type="text" v-model="deletingModal.reason" required></b-form-input>
                                </b-form-group>
                                <b-button variant="danger" type="submit" v-bind:disabled="actionLoad">
                                    <span v-if="!actionLoad">Удалить</span>
                                    <span v-else>
                                    <b-spinner small></b-spinner>
                                    Подождите...
                                </span>
                                </b-button>
                            </b-form>
                        </b-modal>
                        <!--Edit modal-->
                        <b-modal :id="editingModal.id" @hide="resetEditingModal" size="sm" title="Списание" hide-footer centered>
                            <b-form @submit.prevent="editPart(editingModal.index)">
                                <b-form-group label="Ширина:">
                                    <b-form-input type="number" :state="editWidthError" step="0.01" v-model="editingModal.width" required></b-form-input>
                                    <b-form-invalid-feedback :state="editWidthError">
                                        Недопустимое значение
                                    </b-form-invalid-feedback>
                                </b-form-group>
                                <b-form-group label="Длина:">
                                    <b-form-input type="number" :state="editLenghtError" step="0.01" v-model="editingModal.lenght" required></b-form-input>
                                    <b-form-invalid-feedback :state="editLenghtError">
                                        Недопустимое значение
                                    </b-form-invalid-feedback>
                                </b-form-group>
                                <b-form-group label="Причина:">
                                    <b-form-input type="text" v-model="editingModal.reason" required></b-form-input>
                                </b-form-group>
                                <b-button variant="danger" type="submit" v-bind:disabled="actionLoad">
                                    <span v-if="!actionLoad">Списать</span>
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
                                    v-model="partsCurrentPage"
                                    :total-rows="partsRows"
                                    :per-page="partsPerPage"
                                    aria-controls="my-table"
                                    v-if="!partsIsBusy"
                                ></b-pagination>
                            </b-col>
                            <b-col sm="5" md="6" class="my-1">
                                <b-form-group
                                    label="Элементов на странице:"
                                    label-cols-sm="6"
                                    label-cols-md="4"
                                    label-cols-lg="6"
                                    label-align-sm="right"
                                    label-for="partsPerPageSelect"
                                    class="mb-0"
                                >
                                    <b-form-select
                                        v-model="partsPerPage"
                                        id="partsPerPageSelect"
                                        :options="pageOptions"
                                    ></b-form-select>
                                </b-form-group>
                            </b-col>
                        </b-row>
                    </b-card-text>
                </b-tab>
                <b-tab title="Операции">
                    <b-card-text>
                        <b-row class="mb-3">
                            <b-col lg="5">
                                <b-form-group
                                    label="Фильтр"
                                    label-cols-sm="3"
                                    label-align-sm="left"
                                    label-for="partsFilterInput"
                                    class="mb-0"
                                >
                                    <b-input-group>
                                        <b-form-input
                                            v-model="actionsFilter"
                                            type="search"
                                            id="partsFilterInput"
                                            placeholder="Введите для поиска..."
                                        ></b-form-input>
                                        <b-input-group-append>
                                            <b-button :disabled="!actionsFilter" @click="actionsFilter = ''">Очистить</b-button>
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
                                    <b-form-checkbox-group v-model="actionsFilterOn" class="mt-1">
                                        <b-form-checkbox value="type">Действие</b-form-checkbox>
                                        <b-form-checkbox value="user">Пользователь</b-form-checkbox>
                                        <b-form-checkbox value="reason">Причина</b-form-checkbox>
                                    </b-form-checkbox-group>
                                </b-form-group>
                            </b-col>
                        </b-row>

                        <date-range-picker
                            :locale-data="{ firstDay: 1, format: 'DD-MM-YYYY' }"
                            v-model="dateRange"
                        >
                        </date-range-picker>
                        <b-table
                            show-empty
                            empty-text="Нет записей"
                            empty-filtered-text="По данному запросу нет записей"
                            id="my-table"
                            :items="actions"
                            :fields="actions_fields"
                            :per-page="actionsPerPage"
                            :current-page="actionsCurrentPage"
                            :striped="true"
                            :busy="actionsIsBusy"
                            :filter="actionsFilter"
                            :filterIncludedFields="actionsFilterOn"
                        >
                            <template v-slot:cell(type)="data">
                                <b :class="'text-'+data.item.type.color">{{ data.item.type.label }}</b>
                            </template>
                            <template v-slot:cell(user)="data">
                                {{ data.item.user.alias }}
                            </template>
                            <template v-slot:table-busy>
                                <div class="text-center text-primary my-2">
                                    <b-spinner class="align-middle"></b-spinner>
                                </div>
                            </template>
                        </b-table>
                        <b-row>
                            <b-col sm="5" md="6" class="my-1">
                                <b-pagination
                                    v-model="actionsCurrentPage"
                                    :total-rows="actionsRows"
                                    :per-page="actionsPerPage"
                                    aria-controls="my-table"
                                    v-if="!actionsIsBusy"
                                ></b-pagination>
                            </b-col>
                            <b-col sm="5" md="6" class="my-1">
                                <b-form-group
                                    label="Элементов на странице:"
                                    label-cols-sm="6"
                                    label-cols-md="4"
                                    label-cols-lg="6"
                                    label-align-sm="right"
                                    label-for="actionsPerPageSelect"
                                    class="mb-0"
                                >
                                    <b-form-select
                                        v-model="actionsPerPage"
                                        id="actionsPerPageSelect"
                                        :options="pageOptions"
                                    ></b-form-select>
                                </b-form-group>
                            </b-col>
                        </b-row>
                    </b-card-text>
                </b-tab>
            </b-tabs>
        </b-card>
    </div>
</template>

<script>
    import DateRangePicker from 'vue2-daterange-picker'
    import 'vue2-daterange-picker/dist/vue2-daterange-picker.css'
    import moment from "moment";
    export default {
        name: "RollStorageSingleComponent",
        components: { DateRangePicker },
        props:['id'],
        data() {
            return {
                partsPerPage: 10,
                partsCurrentPage: 1,
                partsIsBusy: false,
                actionLoad: false,
                pageOptions: [5, 10, 15],
                partsFilter: null,
                partsFilterOn: [],
                parts_fields: [
                    {
                        key: 'type',
                        label: 'Тип',
                        sortable: true
                    },
                    {
                        key: 'provider',
                        label: 'Поставщик',
                        sortable: true
                    },
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
                        label: 'Цена',
                        sortable: true
                    },
                    {
                        key: 'status',
                        label: 'Статус',
                        sortable: true
                    },
                    {
                        key: 'delete',
                        label: 'Действия'
                    }
                ],
                item: {},
                parts: [],
                new_part: {},
                providers: [],
                part_statuses: [],
                part_types: [],
                actions: [],
                actionsPerPage: 10,
                actionsCurrentPage: 1,
                actionsIsBusy: false,
                actions_fields: [
                    {
                        key: 'type',
                        label: 'Действие',
                        sortable: true,
                    },
                    {
                        key: 'user',
                        label: 'Пользователь',
                        sortable: true
                    },
                    {
                        key: 'reason',
                        label: 'Причина',
                        sortable: true
                    },
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
                        key: 'created_at',
                        label: 'Дата, время',
                        sortable: true
                    },
                ],
                actionsFilter: null,
                actionsFilterOn: [],
                editingModal: {
                    id: 'edMod',
                    part_id: null,
                    index: null,
                    width: null,
                    lenght: null,
                    reason: '',
                },
                deletingModal: {
                    id: 'delMod',
                    index: null,
                },
                //datepicker
                dateRange: {
                    startDate: moment().startOf('month'),
                    endDate: moment().endOf('month'),
                },
            }
        },
        computed: {
            partsRows() {
                return this.parts.length
            },
            partsSortOptions() {
                // Create an options list from our fields
                return this.parts_fields
                    .filter(f => f.sortable)
                    .map(f => {
                        return { text: f.label, value: f.key }
                    })
            },
            actionsRows() {
                return this.actions.length
            },
            actionsSortOptions() {
                // Create an options list from our fields
                return this.actions_fields
                    .filter(f => f.sortable)
                    .map(f => {
                        return { text: f.label, value: f.key }
                    })
            },
            editWidthError() {
                return this.editingModal.width && this.editingModal.width != 0 && this.editingModal.width <= this.parts[this.editingModal.index].width
            },
            editLenghtError() {
                return this.editingModal.lenght && this.editingModal.lenght != 0 && this.editingModal.lenght <= this.parts[this.editingModal.index].lenght
            },
        },
        created() {
            this.loadItem();
            this.loadActions();
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
            loadActions() {
                axios.post('/admin/storage/roll_actions/getAll', {
                    roll_storage_id: this.id
                })
                    .then((response) => {
                        console.log(response.data);
                        this.actions = response.data;
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
                this.new_part.roll_storage_id = this.id;
                axios.post('/admin/storage/roll_parts', {
                    part: this.new_part,
                })
                    .then((response) => {
                        this.parts.push(response.data);
                        this.addAction(1, this.new_part.reason, this.new_part.width, this.new_part.lenght);
                        this.new_part = {};
                        this.actionLoad = false;
                        this.$refs['modalAddPart'].hide();
                    });
            },
            addAction(type, reason, width, lenght){
                axios.post('/admin/storage/roll_actions', {
                    action: {
                        roll_storage_id: this.id,
                        type_id: type,
                        reason: reason,
                        width: width,
                        lenght: lenght,
                    }
                })
                    .then((response) => {
                        console.log(response.data);
                        this.actions.push(response.data);
                    })
            },
            deletePart(index){
                this.actionLoad = true;
                axios.delete('/admin/storage/roll_parts/'+this.parts[index].id)
                    .then((response) => {
                        this.addAction(2, this.deletingModal.reason, this.parts[index].width, this.parts[index].lenght);
                        this.$delete(this.parts, index);
                        this.actionLoad = false;
                        this.$bvModal.hide(this.deletingModal.id);
                        this.deletingModal.index = null;
                    });
            },
            deleteModal(index) {
                this.deletingModal.index = index;
                this.$root.$emit('bv::show::modal', this.deletingModal.id);
            },
            editPart(index) {
                if(!this.editWidthError || !this.editLenghtError) return false;
                this.actionLoad = true;
                if(this.editingModal.lenght == this.parts[index].lenght && this.editingModal.width == this.parts[index].width){
                    this.deletingModal.reason = this.editingModal.reason;
                    this.deletePart(index);
                    this.actionLoad = false;
                    this.$bvModal.hide(this.editingModal.id);
                    return false;
                }
                axios.put('/admin/storage/roll_parts/'+this.editingModal.part_id, {
                    part: {
                        lenght: this.parts[index].lenght - this.editingModal.lenght,
                    }
                })
                    .then((response) => {
                        this.addAction(2, this.editingModal.reason, this.editingModal.width, this.editingModal.lenght);
                        if(this.editingModal.width < this.parts[index].width){
                            this.cutPart(index);
                        }
                        _.extend(this.parts[index], response.data);
                        this.actionLoad = false;
                        this.$bvModal.hide(this.editingModal.id);
                    });
            },
            cutPart(index){
                this.new_part.width =  this.parts[index].width - this.editingModal.width;
                this.new_part.lenght = this.editingModal.lenght;
                this.new_part.price = this.parts[index].price;
                this.new_part.reason = this.editingModal.reason;
                this.new_part.type_id = 2;
                this.new_part.status_id = this.parts[index].status_id;
                this.new_part.provider_id = this.parts[index].provider_id;
                this.addPart()
            },
            editModal(index, part) {
                this.editingModal.index = index;
                this.editingModal.part_id = part.id;
                this.$root.$emit('bv::show::modal', this.editingModal.id);
            },
            resetEditingModal() {
                this.editingModal.index = null;
                this.editingModal.part_id = null;
                this.editingModal.width = null;
                this.editingModal.lenght = null;
                this.editingModal.reason = '';
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
                this.partsCurrentPage = 1;
                this.actionsCurrentPage = 1;
            },
        }
    }
</script>

<style scoped>

</style>
