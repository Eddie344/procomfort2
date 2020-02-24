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
                                        @change="changeMetal(data.item)"
                                    >
                                        <template v-slot:first>
                                            <option :value="null" disabled>Выберите позицию на складе...</option>
                                        </template>
                                    </b-form-select>
                                </template>
                                <template v-slot:cell(depends)="data">
                                    <b-form-select
                                        size="sm"
                                        v-model="data.item.depends"
                                        :options="dependsOf"
                                    >
                                        <template v-slot:first>
                                            <option :value="null" disabled>Выберите зависимость...</option>
                                        </template>
                                    </b-form-select>
                                </template>

                            </b-table>
                        </b-card-text>
                    </b-tab>
                    <b-tab title="Фурнитура">
                        <b-card-text>
                            <b-table striped hover :items="furn_retirements" :fields="furn_fields">
                                <template v-slot:cell(furn.label)="data">
                                    <b-form-select
                                        size="sm"
                                        v-model="data.item.furn_id"
                                        :options="furn_storages"
                                        value-field="id"
                                        text-field="label"
                                        @change="changeFurn(data.item)"
                                    >
                                        <template v-slot:first>
                                            <option :value="null" disabled>Выберите позицию на складе...</option>
                                        </template>
                                    </b-form-select>
                                </template>
                                <template v-slot:cell(depends)="data">
                                    <b-form-select
                                        size="sm"
                                        v-model="data.item.depends"
                                        :options="dependsOf"
                                    >
                                        <template v-slot:first>
                                            <option :value="null" disabled>Выберите зависимость...</option>
                                        </template>
                                    </b-form-select>
                                </template>
                            </b-table>
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
                dependsOf: [
                    {
                        value: 'width',
                        text: 'Ширина'
                    },
                    {
                        value: 'height',
                        text: 'Высота'
                    },
                    {
                        value: 'count',
                        text: 'Количество'
                    },
                ],
                product_type_selected: null,
                construction_type_selected: null,
                product_types: {},
                construction_types: {},
                metal_retirements: [],
                furn_retirements: [],
                metal_storages: {},
                furn_storages: {},
                metal_fields: [
                    {
                        key: 'label',
                        label: 'Наименование',
                    },
                    {
                        key: 'count',
                        label: 'Количество',
                    },
                    {
                        key: 'depends',
                        label: 'Зависимость',
                    },
                    {
                        key: 'dependsCount',
                        label: 'Коэффициент зависимости',
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
                        key: 'count',
                        label: 'Количество',
                    },
                    {
                        key: 'depends',
                        label: 'Зависимость',
                    },
                    {
                        key: 'dependsCount',
                        label: 'Коэффициент зависимости',
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
            changeMetal(item) {
                axios.put(`/admin/other/metal_retirements/${item.id}`, {
                    item: {
                        metal_id: item.metal_id
                    },
                })
                    .then((response) => {
                        console.log(response.data)
                    })
            },
            changeFurn(item) {
                axios.put(`/admin/other/furn_retirements/${item.id}`, {
                    item: {
                        furn_id: item.furn_id
                    },
                })
                    .then((response) => {
                        console.log(response.data)
                    })
            },
        }
    }
</script>

<style scoped>

</style>
