<template>
    <div>
        <b-form inline class="mb-3">
            <b-button class="mr-3" variant="success" v-b-modal.modalAddProvider v-if="tableLoaded && !isBusy">Добавить</b-button>
            <b-modal ref="modalAddProvider" id="modalAddProvider" size="sm" title="Добавление" hide-footer centered>
                <b-form @submit.prevent="addItem">
                    <b-form-group label="Наименование:">
                        <b-form-input type="text" :state="validation" v-model="new_item.label" required></b-form-input>
                        <b-form-invalid-feedback :state="validation">
                            Данный поставщик уже существует
                        </b-form-invalid-feedback>
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
        </b-form>
        <b-table
            v-if="tableLoaded"
            show-empty
            empty-text="Нет записей"
            empty-filtered-text="По данному запросу нет записей"
            id="my-table"
            :items="providers"
            :fields="fields"
            :striped="true"
            :busy="isBusy"
        >
            <template v-slot:cell(label)="data">
                {{ data.item.label }}
            </template>
            <template v-slot:cell(delete)="data">
                <b-button class="p-0" variant="link" @click="deleteModal(data.index)"><h5 class="d-inline"><i class="fa fa-trash-o text-danger"></i></h5></b-button>
            </template>
            <template v-slot:table-busy>
                <div class="text-center text-primary my-2">
                    <b-spinner class="align-middle"></b-spinner>
                </div>
            </template>
        </b-table>
        <!--Delete modal-->
        <b-modal :id="deletingModal.id" size="sm" title="Вы уверены?" @hide="deletingModal.error = false" centered>
            <b-alert variant="danger" show v-if="deletingModal.error">Нельзя удалить поставщика, которому принадлежат ткани на складе</b-alert>
            <template v-slot:modal-footer="{ ok }">
                <b-button variant="danger" @click="deleteItem(deletingModal.index)" v-bind:disabled="actionLoad">
                    <span v-if="!actionLoad">Удалить</span>
                    <span v-else>
                        <b-spinner small></b-spinner>
                        Подождите...
                    </span>
                </b-button>
            </template>
        </b-modal>
    </div>
</template>

<script>
    export default {
        name: "CategoryComponent",
        data() {
            return {
                tableLoaded: false,
                providers: [],
                new_item: {},
                actionLoad: false,
                isBusy: false,
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
                deletingModal: {
                    id: 'delMod',
                    index: null,
                    error: false,
                },

            }
        },
        computed: {
            validation() {
                return !this.providers.some(i =>  i.label == this.new_item.label);
            }
        },
        mounted() {
            this.load();
        },
        methods: {
            load(){
                this.isBusy = true;
                axios.post('/admin/other/providers/get')
                    .then((response) => {
                        console.log(response.data);
                        this.providers = response.data;
                        this.isBusy = false;
                        this.tableLoaded = true;
                    });
            },
            addItem(){
                if(!this.validation) return false;
                this.actionLoad = true;
                axios.post('/admin/other/providers', {
                    item: this.new_item
                })
                    .then((response) => {
                        this.providers.push(response.data);
                        this.new_item = {};
                        this.actionLoad = false;
                        this.$refs['modalAddProvider'].hide();
                        this.makeToast('Поставщик успешно добавлен', 'success');
                    });
            },
            deleteItem(index){
                this.actionLoad = true;
                axios.delete('/admin/other/providers/'+this.providers[index].id)
                    .then((response) => {
                        this.$delete(this.providers, index);
                        this.actionLoad = false;
                        this.$bvModal.hide(this.deletingModal.id);
                        this.deletingModal.index = null;
                        this.makeToast('Поставщик успешно удален', 'danger');
                    })
                    .catch(error => {
                        this.actionLoad = false;
                        this.deletingModal.error = true;
                    });
            },
            deleteModal(index) {
                this.deletingModal.index = index;
                this.$root.$emit('bv::show::modal', this.deletingModal.id);
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
