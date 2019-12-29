<template>
    <div>
        <b-form inline class="mb-3">
            <b-form-select class="mr-3" v-model="product_type_selected" @change="getConstructionTypes">
                <option :value="null" disabled selected>Выберите тип изделия...</option>
                <option v-for="p in product_types" v-bind:value="p.id">{{ p.label }}</option>
            </b-form-select>
            <b-form-select class="mr-3" v-model="construction_type_selected" @change="loadRetirements" v-if="product_type_selected && construction_types.length">
                <option :value="null" disabled selected>Выберите тип конструкции...</option>
                <option v-for="c in construction_types" v-bind:value="c.id">{{ c.label }}</option>
            </b-form-select>
        </b-form>
        <div v-if="tableLoaded">
            <b-card no-body>
                <b-tabs card>
                    <b-tab title="Метал" active>
                        <b-card-text>
                            <b-table striped hover :items="metal_retirements" :fields="metal_fields">
                                <template v-slot:cell(metal.label)="data">
                                    <b-form-select
                                        size="sm"
                                        v-model="data.item.metal_id"
                                        :options="metal_storages"
                                        value-field="id"
                                        text-field="label"
                                    >
                                        <template v-slot:first>
                                            <option :value="null" disabled>Выберите позицию на складе...</option>
                                        </template>
                                    </b-form-select>
                                </template>
                            </b-table>
                        </b-card-text>
                    </b-tab>
                    <b-tab title="Фурнитура">
                        <b-card-text>
                            <b-table striped hover :items="furn_retirements" :fields="furn_fields"></b-table>
                        </b-card-text>
                    </b-tab>
                </b-tabs>
            </b-card>
        </div>
    </div>
</template>

<script>
    export default {
        name: "RetirementComponent",
        data() {
            return {
                tableLoaded: false,
                product_type_selected: null,
                construction_type_selected: null,
                product_types: {},
                construction_types: {},
                metal_retirements: {},
                furn_retirements: {},
                metal_storages: {},
                furn_storages: {},
                metal_fields: [
                    {
                        key: 'label',
                        label: 'Наименование',
                    },
                    {
                        key: 'metal.label',
                        label: 'Позиция на складе',
                    }
                ],
                furn_fields: [
                    {
                        key: 'label',
                        label: 'Наименование',
                    },
                    {
                        key: 'furn.label',
                        label: 'Позиция на складе',
                    }
                ],
            }
        },
        mounted(){
            this.getProductTypes();
        },
        methods: {
            getProductTypes(){
                axios.post('/admin/other/product_types/get')
                    .then((response) => {
                        this.product_types = response.data;
                    });
            },
            getConstructionTypes(){
                axios.post('/admin/other/construction_types/get', {
                    product_type_id: this.product_type_selected,
                })
                    .then((response) => {
                        this.construction_types = response.data;
                        this.construction_type_selected = null;
                        this.tableLoaded = false;
                        if(!this.construction_types.length) {
                            this.loadRetirements();
                        }
                    });
            },
            loadRetirements() {
                this.loadMetalStorages();
                this.loadFurnStorages();
                this.loadMetalRetirements();
                this.loadFurnRetirements();
                this.tableLoaded = true;
            },
            loadMetalRetirements() {
                axios.post('/admin/other/metal_retirements/getAll', {
                    type_id: this.product_type_selected,
                    construction_id: this.construction_type_selected,
                })
                    .then((response) => {
                        this.metal_retirements = response.data;
                    })
            },
            loadFurnRetirements() {
                axios.post('/admin/other/furn_retirements/getAll', {
                    type_id: this.product_type_selected,
                    construction_id: this.construction_type_selected,
                })
                    .then((response) => {
                        this.furn_retirements = response.data;
                    })
            },
            loadMetalStorages(){
                axios.post('/admin/storage/metal/getAll')
                    .then((response) => {
                        this.metal_storages = response.data;
                    });
            },
            loadFurnStorages(){
                axios.post('/admin/storage/furn/getAll')
                    .then((response) => {
                        this.furn_storages = response.data;
                    });
            },
            changeMetal() {

            },
        }
    }
</script>

<style scoped>

</style>
