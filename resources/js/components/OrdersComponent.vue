<template>
    <div>
        <b-row class="mb-3">
            <b-col lg="1">
                <b-button class="mr-3" variant="success" v-b-modal.modalAdd>Добавить</b-button>

                <b-modal ref="modalAdd" id="modalAdd" size="sm" title="Добавление" hide-footer centered>
                    <b-form @submit.prevent="addOrder">
                        <b-form-group label="Заказчик:">
                            <v-select :options="users"
                                v-model="new_order.diller_id"
                                :reduce="alias => alias.id"
                                label="alias"
                                placeholder="Выберите заказчика">
                                                            </v-select>
                                <!--                            <b-form-select-->
<!--                                v-model="new_order.diller_id"-->
<!--                                :options="users"-->
<!--                                class="mb-3"-->
<!--                                value-field="id"-->
<!--                                text-field="alias"-->
<!--                                required-->
<!--                            >-->
<!--                                <template v-slot:first>-->
<!--                                    <option :value="null" disabled selected>Выберите заказчика...</option>-->
<!--                                </template>-->
<!--                            </b-form-select>-->
                        </b-form-group>
                        <b-form-group label="Префикс:">
                            <b-form-input type="text" v-model="new_order.prefix" required></b-form-input>
                        </b-form-group>
                        <b-form-group label="Тип изделия:">
                            <b-form-select
                                v-model="new_order.product_type_id"
                                :options="product_types"
                                class="mb-3"
                                value-field="id"
                                text-field="label"
                                @change="getConstructionTypes(new_order.product_type_id, new_order.construction_type_id)"
                                required
                            >
                                <template v-slot:first>
                                    <option :value="null" disabled selected>Выберите тип изделия...</option>
                                </template>
                            </b-form-select>
                        </b-form-group>
                        <b-form-group label="Тип конструкции:" v-if="new_order.product_type_id && construction_types.length">
                            <b-form-select
                                v-model="new_order.construction_type_id"
                                :options="construction_types"
                                class="mb-3"
                                value-field="id"
                                text-field="label"
                                required
                            >
                                <template v-slot:first>
                                    <option :value="null" disabled selected>Выберите тип конструкции...</option>
                                </template>
                            </b-form-select>
                        </b-form-group>
                        <b-form-group label="Тип оплаты:">
                            <b-form-select
                                v-model="new_order.payment_type_id"
                                :options="payment_types"
                                class="mb-3"
                                value-field="id"
                                text-field="label"
                                required
                            >
                                <template v-slot:first>
                                    <option :value="null" disabled selected>Выберите тип оплаты...</option>
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
            <b-col lg="3" align-self="center">
                <b-form-checkbox name="check-button" switch @change="switchDeleted">
                    Удаленные заказы
                </b-form-checkbox>
            </b-col>
        </b-row>

        <b-row class="mb-3">
            <b-col lg="9">
                <b-form-group
                    label="Фильтровать по:"
                    label-cols-sm="3"
                    class="mb-0">
                    <b-form-checkbox-group v-model="filterOn" class="mt-2">
                        <b-form-checkbox value="id">Номер заказа</b-form-checkbox>
                        <b-form-checkbox value="user.alias">Заказчик</b-form-checkbox>
                        <b-form-checkbox value="productType.label">Тип изделия</b-form-checkbox>
                        <b-form-checkbox value="paymentType.label">Тип оплаты</b-form-checkbox>
                    </b-form-checkbox-group>
                </b-form-group>
            </b-col>
            <b-col lg="3">
                <date-range-picker
                    :locale-data="{ firstDay: 1, format: 'DD-MM-YYYY' }"
                    v-model="dateRange"
                    @update="applyDatePicker"
                    :localeData="localeData"
                    :ranges="ranges"
                    opens="left"
                >
                </date-range-picker>
            </b-col>
        </b-row>
        <b-table
            show-empty
            empty-text="Нет записей"
            empty-filtered-text="По данному запросу нет записей"
            id="my-table"
            :items="orders"
            :fields="fields"
            :per-page="perPage"
            :current-page="currentPage"
            :striped="true"
            :busy="isBusy"
            :filter="filter"
            :filterIncludedFields="filterOn"
        >
            <template v-slot:cell(prefix)="data">
                <a :href="'/admin/orders/'+ data.item.id"><strong>{{ data.item.prefix }}</strong></a>
            </template>
            <template v-slot:cell(diller.alias)="data">
                <a :href="'/admin/users/'+ data.item.diller.id">{{ data.item.diller.alias }}</a>
            </template>
            <template v-slot:cell(status.label)="data">
                <b :class="'text-'+data.item.status.color">{{ data.item.status.label }}</b>
            </template>
            <template v-slot:cell(product_type)="data">
                {{ data.item.product_type.label }} <span v-if="data.item.construction_type_id">{{ data.item.construction_type.label }}</span>
            </template>
            <template v-slot:cell(delete)="data">
                <div v-if="!orders[data.index].deleted_at">
                    <b-button class="p-0" variant="link" @click="editModal(data.item)"><h5 class="d-inline"><i class="fa fa-pencil text-primary"></i></h5></b-button>
                    <b-button class="p-0" variant="link" @click="deleteModal(data.item.id)"><h5 class="d-inline"><i class="fa fa-trash-o text-danger"></i></h5></b-button>
                </div>
                <div v-else>
                    <b-button class="p-0" variant="link" @click="restoreOrder(data.item.id)"><h5 class="d-inline"><i class="fa fa-arrow-up text-success"></i></h5></b-button>
                </div>
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
                <b-button variant="danger" @click="deleteOrder(deletingModal.order_id)" v-bind:disabled="actionLoad">
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
            <b-form @submit.prevent="editOrder">
                <b-form-group label="Заказчик:">
                    <b-form-select
                        v-model="editingModal.diller_id"
                        :options="users"
                        class="mb-3"
                        value-field="id"
                        text-field="alias"
                        required
                    >
                        <template v-slot:first>
                            <option :value="null" disabled selected>Выберите заказчика...</option>
                        </template>
                    </b-form-select>
                </b-form-group>
                <b-form-group label="Префикс:">
                    <b-form-input type="text" v-model="editingModal.prefix" required></b-form-input>
                </b-form-group>
                <b-form-group label="Тип изделия:">
                    <b-form-select
                        v-model="editingModal.product_type_id"
                        :options="product_types"
                        class="mb-3"
                        value-field="id"
                        text-field="label"
                        @change="changeEditingProductType(editingModal.product_type_id)"
                        required
                    >
                        <template v-slot:first>
                            <option :value="null" disabled selected>Выберите тип изделия...</option>
                        </template>
                    </b-form-select>
                </b-form-group>
                <b-form-group label="Тип конструкции:" v-if="editingModal.product_type_id && construction_types.length">
                    <b-form-select
                        v-model="editingModal.construction_type_id"
                        :options="construction_types"
                        class="mb-3"
                        value-field="id"
                        text-field="label"
                        required
                    >
                        <template v-slot:first>
                            <option :value="null" disabled selected>Выберите тип конструкции...</option>
                        </template>
                    </b-form-select>
                </b-form-group>
                <b-form-group label="Тип оплаты:">
                    <b-form-select
                        v-model="editingModal.payment_type_id"
                        :options="payment_types"
                        class="mb-3"
                        value-field="id"
                        text-field="label"
                        required
                    >
                        <template v-slot:first>
                            <option :value="null" disabled selected>Выберите тип оплаты...</option>
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
    import DateRangePicker from 'vue2-daterange-picker'
    import 'vue2-daterange-picker/dist/vue2-daterange-picker.css'
    import moment from "moment";
    moment.locale('ru');
    export default {
        name: "OrdersComponent",
        components: { DateRangePicker },
        props: ['auth_user'],
        data() {
            return {
                perPage: 10,
                currentPage: 1,
                fields: [
                    {
                        key: 'id',
                        label: '№',
                        sortable: true,
                    },
                    {
                        key: 'prefix',
                        label: 'Префикс',
                        sortable: true,
                    },
                    {
                        key: 'diller.alias',
                        label: 'Заказчик',
                        sortable: true,
                    },
                    {
                        key: 'product_type',
                        label: 'Вид изделия',
                        sortable: true,
                    },
                    {
                        key: 'payment_type.label',
                        label: 'Тип оплаты',
                        sortable: true,
                    },
                    {
                        key: 'created_at',
                        label: 'Время создания',
                        sortable: true,
                    },
                    {
                        key: 'status.label',
                        label: 'Статус',
                        sortable: true,
                    },
                    {
                        key: 'delete',
                        label: 'Действия'
                    }
                ],
                orders: [],
                deleted: false,
                new_order: {
                    diller_id: null,
                    product_type_id: null,
                    payment_type_id: null,
                    construction_type_id: null,
                },
                isBusy: false,
                actionLoad: false,
                pageOptions: [5, 10, 15],
                filter: null,
                filterOn: [],
                deletingModal: {
                    id: 'delMod',
                    index: null,
                },
                editingModal: {
                    id: 'edMod',
                    order_id: null,
                    diller_id: null,
                    prefix: '',
                    product_type_id: null,
                    construction_type_id: null,
                    payment_type_id: null,
                },
                users: [],
                product_types: [],
                construction_types: [],
                payment_types: [],
                statuses: [],
                //datepicker
                dateRange: {
                    startDate: moment().startOf('month').hour(0).minute(0).second(0),
                    endDate: moment().endOf('month').hour(23).minute(59).second(59),
                },
                localeData: {
                    direction: 'ltr',
                    format: moment.localeData().longDateFormat('L'),
                    separator: ' - ',
                    applyLabel: 'Применить',
                    cancelLabel: 'Отмена',
                    weekLabel: 'W',
                    customRangeLabel: 'Custom Range',
                    daysOfWeek: moment.weekdaysMin(),
                    monthNames: moment.monthsShort(),
                    firstDay: moment.localeData().firstDayOfWeek()
                },
                ranges:{
                    'Сегодня': [moment(), moment()],
                    'Вчера': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'В этом месяце': [moment().startOf('month'), moment().endOf('month')],
                    'В этом году': [moment().startOf('year'), moment().endOf('year')],
                    'На прошлой неделе': [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')],
                    'В прошлом месяце': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                }
            }
        },
        computed: {
            rows() {
                return this.orders.length
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
            this.getUsers();
            this.getProductTypes();
            this.getPaymentTypes();
            this.getStatuses();
        },
        methods:{
            applyDatePicker(){
                this.dateRange.startDate = moment(this.dateRange.startDate).hour(0).minute(0).second(0);
                this.dateRange.endDate = moment(this.dateRange.endDate).hour(23).minute(59).second(59);
                this.load();
            },
            load(){
                this.isBusy = true;
                axios.post('/admin/orders/getAll', {
                    deleted: this.deleted,
                    startDate: moment(this.dateRange.startDate),
                    endDate: moment(this.dateRange.endDate),
                })
                    .then((response) => {
                        this.orders = response.data;
                        this.isBusy = false;
                    });
            },
            switchDeleted() {
                this.deleted = !this.deleted;
                this.load();
            },
            addOrder(){
                this.actionLoad = true;
                axios.post('/admin/orders', {
                    order: this.new_order
                })
                    .then((response) => {
                        this.load();
                        this.new_order = {};
                        this.actionLoad = false;
                        this.$refs['modalAdd'].hide();
                        this.makeToast('Заказ успешно добавлен', 'success');
                    });
            },
            editOrder() {
                this.actionLoad = true;
                axios.put('/admin/orders/'+this.editingModal.order_id, {
                    order: this.editingModal
                })
                    .then((response) => {
                        _.extend(this.orders[index], response.data);
                        this.actionLoad = false;
                        this.$bvModal.hide(this.editingModal.id);
                        this.makeToast('Данные заказа успешно сохранены', 'success');
                    });
            },
            deleteOrder(id){
                this.actionLoad = true;
                axios.delete('/admin/orders/'+id)
                    .then((response) => {
                        this.load();
                        this.actionLoad = false;
                        this.$bvModal.hide(this.deletingModal.id);
                        this.deletingModal.order_id = null;
                        this.makeToast('Заказ успешно удален', 'danger');
                    });
            },
            restoreOrder(id) {
                this.actionLoad = true;
                axios.post(`/admin/orders/restore/${id}`)
                    .then((response) => {
                        this.load();
                        this.actionLoad = false;
                        this.makeToast('Заказ успешно восстановлен', 'success');
                    });
            },
            deleteModal(id) {
                this.deletingModal.order_id = id;
                this.$root.$emit('bv::show::modal', this.deletingModal.id);
            },
            editModal(item) {
                this.editingModal.order_id = item.id;
                this.editingModal.diller_id = item.diller_id;
                this.editingModal.prefix = item.prefix;
                this.editingModal.product_type_id = item.product_type_id;
                this.editingModal.construction_type_id = item.construction_type_id;
                this.editingModal.payment_type_id = item.payment_type_id;
                this.getConstructionTypes(item.product_type_id);
                this.$root.$emit('bv::show::modal', this.editingModal.id);
            },
            resetEditingModal() {
                this.editingModal.index = null;
                this.editingModal.order_id = null;
                this.editingModal.diller_id = null;
                this.editingModal.prefix = '';
                this.editingModal.product_type_id = null;
                this.editingModal.construction_type_id = null;
                this.editingModal.payment_type_id = null;
                this.construction_types = [];
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
            },
            getUsers(){
                axios.post('/admin/users/getAll')
                    .then((response) => {
                        this.users = response.data;
                    });
            },
            getProductTypes(){
                axios.post('/admin/other/product_types/get')
                    .then((response) => {
                        this.product_types = response.data;
                    });
            },
            getConstructionTypes(product_type){
                axios.post('/admin/other/construction_types/get', {
                    product_type_id: product_type
                })
                    .then((response) => {
                        this.construction_types = response.data;
                    });
            },
            getPaymentTypes(){
                axios.post('/admin/other/payment_types/get')
                    .then((response) => {
                        this.payment_types = response.data;
                    });
            },
            getStatuses(){
                axios.post('/admin/other/order_statuses/get')
                    .then((response) => {
                        this.statuses = response.data;
                    });
            },
            changeEditingProductType(product_type){
                this.getConstructionTypes(product_type);
                this.editingModal.construction_type_id = null;
            },
        }
    }
</script>

<style scoped>

</style>
