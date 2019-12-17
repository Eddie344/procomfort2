<template>
    <div>
        <b-row class="mb-3">
            <b-col lg="1">
                <b-button class="mr-3" variant="success" v-b-modal.modalAddPrice>Добавить</b-button>

                <b-modal ref="modalAddPrice" id="modalAddPrice" size="sm" title="Добавление" hide-footer centered>
                    <b-form @submit.prevent="addUser">
                        <b-form-group label="Имя:">
                            <b-form-input type="text" v-model="new_user.name" required></b-form-input>
                        </b-form-group>
                        <b-form-group label="Фамилия:">
                            <b-form-input type="text" v-model="new_user.surname" required></b-form-input>
                        </b-form-group>
                        <b-form-group label="Псевдоним:">
                            <b-form-input type="text" v-model="new_user.alias" required></b-form-input>
                        </b-form-group>
                        <b-form-group label="Город:">
                            <b-form-input type="text" v-model="new_user.city" required></b-form-input>
                        </b-form-group>
                        <b-form-group label="E-mail:">
                            <b-form-input type="email" v-model="new_user.email" required></b-form-input>
                        </b-form-group>
                        <b-form-group label="Телефон:">
                            <b-form-input type="text" v-model="new_user.phone" required></b-form-input>
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
                    Удаленные пользователи
                </b-form-checkbox>
            </b-col>
        </b-row>

        <b-row class="mb-3">
            <b-col lg="12">
                <b-form-group
                    label="Фильтровать по:"
                    label-cols-sm="2"
                    class="mb-0">
                    <b-form-checkbox-group v-model="filterOn" class="mt-2">
                        <b-form-checkbox value="fullName">Имя</b-form-checkbox>
                        <b-form-checkbox value="alias">Псевдоним</b-form-checkbox>
                        <b-form-checkbox value="city">Город</b-form-checkbox>
                        <b-form-checkbox value="email">E-mail</b-form-checkbox>
                        <b-form-checkbox value="phone">Телефон</b-form-checkbox>
                    </b-form-checkbox-group>
                </b-form-group>
            </b-col>
        </b-row>
        <b-table
            show-empty
            empty-text="Нет записей"
            empty-filtered-text="По данному запросу нет записей"
            id="my-table"
            :items="users"
            :fields="fields"
            :per-page="perPage"
            :current-page="currentPage"
            :striped="true"
            :busy="isBusy"
            :filter="filter"
            :filterIncludedFields="filterOn"
        >
            <template v-slot:cell(fullName)="data">
                <a :href="'/admin/users/'+ data.item.id">{{ data.item.name }} {{ data.item.surname }}</a>
            </template>
            <template v-slot:cell(balance)="data">
                {{ data.item.balance }} $
            </template>
            <template v-slot:cell(delete)="data">
                <div v-if="!users[data.index].deleted_at">
                    <b-button class="p-0" variant="link" @click="editModal(data.index)"><h5 class="d-inline"><i class="fa fa-pencil text-primary"></i></h5></b-button>
                    <b-button class="p-0" variant="link" v-if="users[data.index].id !== auth_user" @click="deleteModal(data.index)"><h5 class="d-inline"><i class="fa fa-trash-o text-danger"></i></h5></b-button>
                </div>
                <div v-else>
                    <b-button class="p-0" variant="link" @click="restoreUser(data.index)"><h5 class="d-inline"><i class="fa fa-arrow-up text-success"></i></h5></b-button>
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
                <b-button variant="danger" @click="deleteUser(deletingModal.index)" v-bind:disabled="actionLoad">
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
            <b-form @submit.prevent="editUser(editingModal.index)">
                <b-form-group label="Имя:">
                    <b-form-input type="text" v-model="editingModal.name" required></b-form-input>
                </b-form-group>
                <b-form-group label="Фамилия:">
                    <b-form-input type="text" v-model="editingModal.surname" required></b-form-input>
                </b-form-group>
                <b-form-group label="Псевдоним:">
                    <b-form-input type="text" v-model="editingModal.alias" required></b-form-input>
                </b-form-group>
                <b-form-group label="Город:">
                    <b-form-input type="text" v-model="editingModal.city" required></b-form-input>
                </b-form-group>
                <b-form-group label="E-mail:">
                    <b-form-input type="email" v-model="editingModal.email" required></b-form-input>
                </b-form-group>
                <b-form-group label="Телефон:">
                    <b-form-input type="text" v-model="editingModal.phone" required></b-form-input>
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
        name: "UsersComponent",
        props: ['auth_user'],
        data() {
            return {
                perPage: 10,
                currentPage: 1,
                fields: [
                    {
                        key: 'fullName',
                        label: 'Имя, фамилия',
                    },
                    {
                        key: 'alias',
                        label: 'Псевдоним',
                    },
                    {
                        key: 'city',
                        label: 'Город',
                    },
                    {
                        key: 'phone',
                        label: 'Телефон',
                    },
                    {
                        key: 'email',
                        label: 'E-mail',
                    },
                    {
                        key: 'balance',
                        label: 'Баланс',
                    },
                    {
                        key: 'delete',
                        label: 'Действия'
                    }
                ],
                users: [],
                deleted: false,
                categories: [],
                catalogs: [],
                pictures: [],
                new_user: {},
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
                    user_id: null,
                    name: '',
                    surname: '',
                    alias: '',
                    city: '',
                    phone: '',
                    email: '',
                }
            }
        },
        computed: {
            rows() {
                return this.users.length
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
                console.log(this.deleted);
                axios.post('/admin/users/getAll', {
                    deleted: this.deleted
                })
                    .then((response) => {
                        this.users = response.data;
                        this.isBusy = false;
                    });
            },
            switchDeleted() {
                this.deleted = !this.deleted;
                this.load();
            },
            addUser(){
                this.actionLoad = true;
                axios.post('/admin/users', {
                    user: this.new_user
                })
                    .then((response) => {
                        this.users.push(response.data);
                        this.new_user = {};
                        this.actionLoad = false;
                        this.$refs['modalAddPrice'].hide();
                        this.makeToast('Пользователь усешно добавлен', 'success');
                    });
            },
            editUser(index) {
                this.actionLoad = true;
                axios.put('/admin/users/'+this.editingModal.user_id, {
                    user: this.editingModal
                })
                    .then((response) => {
                        _.extend(this.users[index], response.data);
                        this.actionLoad = false;
                        this.$bvModal.hide(this.editingModal.id);
                        this.makeToast('Данные пользователя успешно сохранены', 'success');
                    });
            },
            deleteUser(index){
                this.actionLoad = true;
                axios.delete('/admin/users/'+this.users[index].id)
                    .then((response) => {
                        this.$delete(this.users, index);
                        this.actionLoad = false;
                        this.$bvModal.hide(this.deletingModal.id);
                        this.deletingModal.index = null;
                        this.makeToast('Пользователь усешно удален', 'danger');
                    });
            },
            restoreUser(index) {
                this.actionLoad = true;
                axios.post(`/admin/users/restore/${this.users[index].id}`)
                    .then((response) => {
                        this.load();
                        this.actionLoad = false;
                        this.makeToast('Пользователь успешно восстановлен', 'success');
                    });
            },
            deleteModal(index) {
                this.deletingModal.index = index;
                this.$root.$emit('bv::show::modal', this.deletingModal.id);
            },
            editModal(index) {
                this.editingModal.index = index;
                this.editingModal.user_id = this.users[index].id;
                this.editingModal.name = this.users[index].name;
                this.editingModal.surname = this.users[index].surname;
                this.editingModal.alias = this.users[index].alias;
                this.editingModal.city = this.users[index].city;
                this.editingModal.phone = this.users[index].phone;
                this.editingModal.email = this.users[index].email;
                this.$root.$emit('bv::show::modal', this.editingModal.id);
            },
            resetEditingModal() {
                this.editingModal.index = null;
                this.editingModal.user_id = null;
                this.editingModal.name = '';
                this.editingModal.surname = '';
                this.editingModal.alias = '';
                this.editingModal.city = '';
                this.editingModal.phone = '';
                this.editingModal.email = '';
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
