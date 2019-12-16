<template>
    <div>
        <h2 class="mb-4">{{ user.name }} {{ user.surname }}</h2>
        <b-card no-body>
            <b-tabs card>
                <b-tab title="Общая информация" active>
                    <b-card-text>
                        <dl class="row">
                            <dt class="col-sm-3">Город:</dt>
                            <dd class="col-sm-9">{{ user.city }}</dd>

                            <dt class="col-sm-3">E-mail:</dt>
                            <dd class="col-sm-9">{{ user.email }}</dd>

                            <dt class="col-sm-3">Телефон:</dt>
                            <dd class="col-sm-9">{{ user.phone }}</dd>

                            <dt class="col-sm-3">Реквизиты:</dt>
                            <dd class="col-sm-9">{{ user.requisites }}</dd>

                        </dl>
                    </b-card-text>
                </b-tab>
                <b-tab title="Информация о заказах">
                    <b-card-text>
                        <dl class="row">
                            <dt class="col-sm-3">Все заказы:</dt>
                            <dd class="col-sm-7">139</dd>

                            <dt class="col-sm-3">Выполненные:</dt>
                            <dd class="col-sm-7">100</dd>

                            <dt class="col-sm-3">В работе:</dt>
                            <dd class="col-sm-7">4</dd>

                            <dt class="col-sm-3">Черновики:</dt>
                            <dd class="col-sm-7">2</dd>
                        </dl>
                        <a class="btn btn-primary" href="#" role="button">Заказы пользователя</a>
                    </b-card-text>
                </b-tab>
                <b-tab title="Баланс и операции">
                    <b-card-text>
                        <div class="row">
                            <div class="col-md-3 d-flex align-items-center">
                                <p><strong>Текущий баланс:</strong> {{user.balance}} $</p>
                            </div>
                            <div class="col-md-4 d-flex align-items-center">
                                <p><strong>Баланс с заказами в работе:</strong> 180$</p>
                            </div>
                            <div class="input-group mb-3 col-md-2">
                                <b-button class="mr-3" variant="primary" v-b-modal.modalEditBalance>Изменить</b-button>

                                <b-modal ref="modalEditBalance" id="modalEditBalance" size="sm" title="Изменение баланса" hide-footer centered>
                                    <b-form @submit.prevent="editBalance">
                                        <b-form-group>
                                            <b-form-checkbox v-model="new_operation_checked" name="check-button" switch>
                                                <span v-if="new_operation_checked">Пополнение</span>
                                                <span v-else>Списание</span>
                                            </b-form-checkbox>
                                        </b-form-group>
                                        <b-form-group label="Сумма:">
                                            <b-form-input type="number" step="0.01" v-model="new_operation.count" required></b-form-input>
                                        </b-form-group>
                                        <b-form-group label="Причина:">
                                            <b-form-input type="text" v-model="new_operation.reason" required></b-form-input>
                                        </b-form-group>
                                        <b-button variant="primary" type="submit" v-bind:disabled="operationLoad">
                                            <span v-if="!operationLoad">Изменить</span>
                                            <span v-else>
                                                <b-spinner small></b-spinner>
                                                Подождите...
                                            </span>
                                        </b-button>
                                    </b-form>
                                </b-modal>
                            </div>
                        </div>
                        <b-row class="mb-3">
                            <b-col lg="5">
                                <b-form-group
                                    label="Фильтр"
                                    label-cols-sm="3"
                                    label-align-sm="left"
                                    label-for="partsFilterInput"
                                    class="mb-3"
                                >
                                    <b-input-group>
                                        <b-form-input
                                            v-model="operationsFilter"
                                            type="search"
                                            id="partsFilterInput"
                                            placeholder="Введите для поиска..."
                                        ></b-form-input>
                                        <b-input-group-append>
                                            <b-button :disabled="!operationsFilter" @click="operationsFilter = ''">Очистить</b-button>
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
                                    <b-form-checkbox-group v-model="operationsFilterOn" class="mt-1">
                                        <b-form-checkbox value="type">Операция</b-form-checkbox>
                                        <b-form-checkbox value="count">Сумма</b-form-checkbox>
                                        <b-form-checkbox value="reason">Причина</b-form-checkbox>
                                    </b-form-checkbox-group>
                                </b-form-group>
                            </b-col>
                            <b-col lg="6">
                                <date-range-picker
                                    :locale-data="{ firstDay: 1, format: 'DD-MM-YYYY' }"
                                    v-model="dateRange"
                                    @update="applyDatePicker"
                                    :localeData="localeData"
                                    :ranges="ranges"
                                    opens="right"
                                >
                                </date-range-picker>
                            </b-col>
                        </b-row>
                        <b-table
                            show-empty
                            empty-text="Нет записей"
                            empty-filtered-text="По данному запросу нет записей"
                            id="my-table"
                            :busy="isOperationsBusy"
                            :items="operations"
                            :fields="operations_fields"
                            :per-page="operationsPerPage"
                            :current-page="operationsCurrentPage"
                            :striped="true"
                            :filter="operationsFilter"
                            :filterIncludedFields="operationsFilterOn"
                            sort-by="created_at"
                            sort-desc
                        >
                            <template v-slot:cell(type)="data">
                                <b :class="'text-'+data.item.type.color">{{ data.item.type.label }}</b>
                            </template>
                            <template v-slot:cell(count)="data">
                                {{ data.item.count }} $
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
                                    v-model="operationsCurrentPage"
                                    :total-rows="operationsRows"
                                    :per-page="operationsPerPage"
                                    aria-controls="my-table"
                                    v-if="!isOperationsBusy"
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
                                        v-model="operationsPerPage"
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
    moment.locale('ru');
    export default {
        name: "UserSingleComponent",
        components: { DateRangePicker },
        props:['id'],
        data() {
            return {
                pageOptions: [5, 10, 15],
                user: {},
                operationLoad: false,
                new_operation: {},
                new_operation_checked: true,
                operations: [],
                isOperationsBusy: false,
                operationsPerPage: 10,
                operationsCurrentPage: 1,
                operations_fields: [
                    {
                        key: 'type',
                        label: 'Операция',
                        sortable: true,
                    },
                    {
                        key: 'count',
                        label: 'Сумма',
                        sortable: true
                    },
                    {
                        key: 'reason',
                        label: 'Причина',
                        sortable: true
                    },
                    {
                        key: 'created_at',
                        label: 'Дата, время',
                        sortable: true
                    },
                ],
                operationsFilter: null,
                operationsFilterOn: [],
                //datepicker
                dateRange: {
                    startDate: moment().hour(0).minute(0).second(0),
                    endDate: moment().hour(23).minute(59).second(59),
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
            operationsRows() {
                return this.operations.length
            },
            operationsSortOptions() {
                // Create an options list from our fields
                return this.operations_fields
                    .filter(f => f.sortable)
                    .map(f => {
                        return { text: f.label, value: f.key }
                    })
            },
        },
        created() {
            this.loadUser();
            this.loadOperations();
        },
        methods: {
            applyDatePicker(){
                this.dateRange.startDate = moment(this.dateRange.startDate).hour(0).minute(0).second(0);
                this.dateRange.endDate = moment(this.dateRange.endDate).hour(23).minute(59).second(59);
                this.loadOperations();
            },
            loadUser() {
                axios.post('/admin/users/get/'+this.id)
                    .then((response) => {
                        this.user = response.data;
                    })
            },
            loadOperations() {
                this.isOperationsBusy = true;
                axios.post('/admin/users/operations/getAll', {
                    user_id: this.user.id,
                    startDate: moment(this.dateRange.startDate),
                    endDate: moment(this.dateRange.endDate),
                })
                    .then((response) => {
                        this.operations = response.data;
                        this.isOperationsBusy = false;
                    })
            },
            editBalance() {
                this.operationLoad = true;
                this.new_operation_checked ? this.new_operation.type_id = 1 : this.new_operation.type_id = 2;
                axios.post('/admin/users/operations', {
                    action: this.new_operation,
                })
                    .then((response) => {
                        this.editUserBalance();
                        this.operations.push(response.data);
                        this.new_operation = {};
                        this.operationLoad = false;
                        this.$refs['modalEditBalance'].hide();
                        this.makeToast('Баланс успешно обновлен', 'success');
                    });
            },
            editUserBalance() {
                let new_balance;
                if(this.new_operation.type_id == 1) {
                    new_balance = parseInt(this.user.balance) + parseInt(this.new_operation.count)
                }
                else {
                    new_balance = parseInt(this.user.balance) - parseInt(this.new_operation.count)
                }
                axios.put(`/admin/users/${this.user.id}`, {
                    user: {
                        balance: new_balance,
                    },
                })
                    .then((response) => {
                        this.user.balance = response.data.balance;
                        console.log(response.data)
                    })
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
        },
    }
</script>

<style scoped>

</style>
