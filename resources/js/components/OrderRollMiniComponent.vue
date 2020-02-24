<template>
    <div>
        <div class="d-inline-flex align-items-center mb-3">
            <b-button class="mr-3" variant="success" v-b-modal.modalAdd>Добавить</b-button>
            <b-modal ref="modalAdd" id="modalAdd" size="sm" title="Добавление" hide-footer centered>
                <b-form @submit.prevent="addProduct">
                    <b-form-group label="Ширина:">
                        <b-form-input type="number" min="0.1" step="0.01" v-model="new_product.width" required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Высота:">
                        <b-form-input type="number" min="0.1" step="0.01" v-model="new_product.height" required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Управление:">
                        <b-form-select
                            v-model="new_product.rule_type_id"
                            :options="rule_types"
                            class="mb-3"
                            value-field="id"
                            text-field="label"
                            required
                        >
                            <template v-slot:first>
                                <option :value="null" disabled selected>Выберите тип управления...</option>
                            </template>
                        </b-form-select>
                    </b-form-group>
                    <b-form-group label="Длина управления:">
                        <b-form-input type="number" step="0.01" v-model="newRuleLenght" required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Комплектация:">
                        <b-form-select
                            v-model="new_product.complectation_type_id"
                            :options="complectation_types"
                            class="mb-3"
                            value-field="id"
                            text-field="label"
                            required
                        >
                            <template v-slot:first>
                                <option :value="null" disabled selected>Выберите тип комплектации...</option>
                            </template>
                        </b-form-select>
                    </b-form-group>
                    <b-form-group label="Ткань:">
                        <b-form-select
                            v-model="new_product.material_id"
                            :options="materials"
                            class="mb-3"
                            value-field="id"
                            text-field="label"
                            required
                        >
                            <template v-slot:first>
                                <option :value="null" disabled selected>Выберите ткань...</option>
                            </template>
                        </b-form-select>
                    </b-form-group>
                    <b-form-group label="Цвет фурнитуры:">
                        <b-form-select
                            v-model="new_product.furn_color_id"
                            :options="furn_colors"
                            class="mb-3"
                            value-field="id"
                            text-field="label"
                            required
                        >
                            <template v-slot:first>
                                <option :value="null" disabled selected>Выберите цвет фурнитуры...</option>
                            </template>
                        </b-form-select>
                    </b-form-group>
                    <b-form-group>
                        <b-form-checkbox
                            id="checkbox-1"
                            v-model="new_product.chain_lock"
                            name="checkbox-1"
                            value="1"
                            unchecked-value="0"
                            switch
                        >
                            Фиксатор цепи
                        </b-form-checkbox>
                        <b-form-checkbox
                            id="checkbox-2"
                            v-model="new_product.chain_tensioner"
                            name="checkbox-1"
                            value="1"
                            unchecked-value="0"
                            switch
                        >
                            Натяжитель цепи
                        </b-form-checkbox>
                        <b-form-checkbox
                            id="checkbox-3"
                            v-model="new_product.fishing_line"
                            name="checkbox-1"
                            value="1"
                            unchecked-value="0"
                            switch
                        >
                            Леска
                        </b-form-checkbox>
                        <b-form-checkbox
                            id="checkbox-4"
                            v-model="new_product.magnets"
                            name="checkbox-1"
                            value="1"
                            unchecked-value="0"
                            switch
                        >
                            Магниты
                        </b-form-checkbox>
                        <b-form-checkbox
                            id="checkbox-5"
                            v-model="new_product.without_drilling"
                            name="checkbox-1"
                            value="1"
                            unchecked-value="0"
                            switch
                        >
                            Крепление без сверления
                        </b-form-checkbox>
                    </b-form-group>
                    <b-form-group label="Количество изделий:">
                        <b-form-input min="1" type="number" v-model="new_product_count" required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Примечание:">
                        <b-form-textarea v-model="new_product.note"></b-form-textarea>
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
            <b-dropdown id="dropdown-left" v-bind:disabled="order.status.id === 7 || products.length == 0" variant="light" class="mr-3">
                <template v-slot:button-content>
                    Статус: <strong v-if="!statusChanging">{{ order.status.label }}</strong> <b-spinner v-if="statusChanging" small label="Обновление..."></b-spinner>
                </template>
                <b-dropdown-item v-if="order.status.id < 7" @click="changeStatus(order.status.id+1)">Изменить до {{ order_statuses[order.status.id].label }}</b-dropdown-item>
                <b-dropdown-item v-if="order.status.id === 2" @click="changeStatus(order.status.id+2)">Изменить до {{ order_statuses[order.status.id+1].label }}</b-dropdown-item>
            </b-dropdown>
            <b-dropdown v-if="order.status.id > 1" text="Комплектация" id="dropdown-left" v-bind:disabled="order.status.id === 7" variant="primary" class="mr-3">
                <b-dropdown-group id="metal-group" header="Метал">
                    <b-dropdown-text>
                        <div v-for="item in metal_retirements" class="d-flex justify-content-between" style="width: 250px;">
                            <span>{{ item.label }}</span>
                            <span>
                                {{ sumProductMetal(item) }} / {{ sumMetalPartsLenght(item) }}
                                <b-icon v-if="parseInt(sumProductMetal(item)) <= parseInt(sumMetalPartsLenght(item))" icon="check" variant="success" font-scale="1.5" shift-v="-1"></b-icon>
                                <b-icon v-else icon="x" variant="danger" font-scale="1.5" shift-v="-1"></b-icon>
                            </span>
                        </div>
                    </b-dropdown-text>
                </b-dropdown-group>
                <b-dropdown-divider></b-dropdown-divider>
                <b-dropdown-group id="furn-group" header="Фурнитура">
                    <b-dropdown-text>
                        <div v-for="item in furn_retirements" class="d-flex justify-content-between" style="width: 250px;">
                            <span>{{ item.label }}</span>
                            <span>
                                {{ sumProductFurn(item) }} / {{ sumFurnPartsCount(item) }}
                                <b-icon v-if="parseInt(sumProductFurn(item)) <= parseInt(sumFurnPartsCount(item))" icon="check" variant="success" font-scale="1.5" shift-v="-1"></b-icon>
                                <b-icon v-else icon="x" variant="danger" font-scale="1.5" shift-v="-1"></b-icon>
                            </span>
                        </div>
                    </b-dropdown-text>
                </b-dropdown-group>
            </b-dropdown>
        </div>
        <b-table
            show-empty
            empty-text="Нет записей"
            empty-filtered-text="По данному запросу нет записей"
            id="my-table"
            :items="products"
            :fields="fields"
            :per-page="perPage"
            :current-page="currentPage"
            :striped="true"
            :busy="isBusy"
        >
            <template v-slot:cell(material.label)="data">
                {{ data.item.material.label }}
                <b-icon :icon="data.item.enoughMaterial ? 'check' : 'x'" :variant="data.item.enoughMaterial ? 'success' : 'danger'" font-scale="1.5" shift-v="-1"></b-icon>
            </template>
            <template v-slot:cell(delete)="data">
                <b-button class="p-0" variant="link" @click="editModal(data.item)"><h5 class="d-inline"><i class="fa fa-pencil text-primary"></i></h5></b-button>
                <b-button class="p-0" variant="link" @click="deleteModal(data.item.id)"><h5 class="d-inline"><i class="fa fa-trash-o text-danger"></i></h5></b-button>
            </template>
        </b-table>
        <!--Edit modal-->
        <b-modal :id="editingModal.id" size="sm" title="Редактирование" hide-footer centered>
            <b-form @submit.prevent="editProduct">
                <b-form-group label="Ширина:">
                    <b-form-input type="number" min="0.1" step="0.01" v-model="editingModal.width" required></b-form-input>
                </b-form-group>
                <b-form-group label="Высота:">
                    <b-form-input type="number" min="0.1" step="0.01" v-model="editingModal.height" required></b-form-input>
                </b-form-group>
                <b-form-group label="Управление:">
                    <b-form-select
                        v-model="editingModal.rule_type_id"
                        :options="rule_types"
                        class="mb-3"
                        value-field="id"
                        text-field="label"
                        required
                    >
                        <template v-slot:first>
                            <option :value="null" disabled selected>Выберите тип управления...</option>
                        </template>
                    </b-form-select>
                </b-form-group>
                <b-form-group label="Длина управления:">
                    <b-form-input type="number" step="0.01" v-model="editingModalLenght" required></b-form-input>
                </b-form-group>
                <b-form-group label="Комплектация:">
                    <b-form-select
                        v-model="editingModal.complectation_type_id"
                        :options="complectation_types"
                        class="mb-3"
                        value-field="id"
                        text-field="label"
                        required
                    >
                        <template v-slot:first>
                            <option :value="null" disabled selected>Выберите тип комплектации...</option>
                        </template>
                    </b-form-select>
                </b-form-group>
                <b-form-group label="Ткань:">
                    <b-form-select
                        v-model="editingModal.material_id"
                        :options="materials"
                        class="mb-3"
                        value-field="id"
                        text-field="label"
                        required
                    >
                        <template v-slot:first>
                            <option :value="null" disabled selected>Выберите ткань...</option>
                        </template>
                    </b-form-select>
                </b-form-group>
                <b-form-group label="Цвет фурнитуры:">
                    <b-form-select
                        v-model="editingModal.furn_color_id"
                        :options="furn_colors"
                        class="mb-3"
                        value-field="id"
                        text-field="label"
                        required
                    >
                        <template v-slot:first>
                            <option :value="null" disabled selected>Выберите цвет фурнитуры...</option>
                        </template>
                    </b-form-select>
                </b-form-group>
                <b-form-group>
                    <b-form-checkbox
                        v-model="editingModal.chain_lock"
                        value="1"
                        unchecked-value="0"
                        switch
                    >
                        Фиксатор цепи
                    </b-form-checkbox>
                    <b-form-checkbox
                        v-model="editingModal.chain_tensioner"
                        value="1"
                        unchecked-value="0"
                        switch
                    >
                        Натяжитель цепи
                    </b-form-checkbox>
                    <b-form-checkbox
                        v-model="editingModal.fishing_line"
                        value="1"
                        unchecked-value="0"
                        switch
                    >
                        Леска
                    </b-form-checkbox>
                    <b-form-checkbox
                        v-model="editingModal.magnets"
                        value="1"
                        unchecked-value="0"
                        switch
                    >
                        Магниты
                    </b-form-checkbox>
                    <b-form-checkbox
                        v-model="editingModal.without_drilling"
                        value="1"
                        unchecked-value="0"
                        switch
                    >
                        Крепление без сверления
                    </b-form-checkbox>
                </b-form-group>
                <b-form-group label="Примечание:">
                    <b-form-textarea v-model="editingModal.note"></b-form-textarea>
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
        <!--Delete modal-->
        <b-modal :id="deletingModal.id" size="sm" title="Вы уверены?" centered>
            <template v-slot:modal-footer="{ ok }">
                <b-button variant="danger" @click="deleteProduct(deletingModal.product_id)" v-bind:disabled="actionLoad">
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
        name: "OrderRollMiniComponent",
        props: ['order'],
        data() {
            return {
                order: this.order,
                perPage: 10,
                currentPage: 1,
                isBusy: false,
                actionLoad: false,
                statusChanging: false,
                fields: [
                    {
                        key: 'width',
                        label: 'Ширина',
                        sortable: true,
                    },
                    {
                        key: 'height',
                        label: 'Высота',
                        sortable: true,
                    },
                    {
                        key: 'rule.label',
                        label: 'Управление',
                        sortable: true,
                    },
                    {
                        key: 'rule_lenght',
                        label: 'Длина управления',
                        sortable: true,
                    },
                    {
                        key: 'complectation.label',
                        label: 'Комплектация',
                        sortable: true,
                    },
                    {
                        key: 'material.label',
                        label: 'Ткань',
                        sortable: true,
                    },
                    {
                        key: 'delete',
                        label: 'Действия'
                    }
                ],
                new_product: {
                    count: 1,
                },
                new_product_count: 1,
                product_additional_metal: {},
                product_additional_furn: {},
                products: [],
                order_statuses: [],
                rule_types: [],
                materials: [],
                complectation_types: [],
                furn_colors: [],
                metal_retirements: [],
                furn_retirements: [],
                deletingModal: {
                    id: 'delMod',
                    index: null,
                },
                editingModal: {
                    id: 'edMod',
                    order_id: this.order.id,
                    type_id: this.order.product_type_id,
                    construction_id: this.order.construction_type_id,
                    width: null,
                    height: null,
                    rule_lenght: null,
                    rule_type_id: null,
                    complectation_type_id: null,
                    material_id: null,
                    furn_color_id: null,
                    chain_lock: false,
                    chain_tensioner: false,
                    fishing_line: false,
                    magnets: false,
                    without_drilling: false,
                    note: '',
                },
            }
        },
        created() {
            this.loadMaterials();
            this.loadRules();
            this.loadComplectations();
            this.loadFurnColors();
            this.loadOrderStatuses();
            this.loadMetalRetirements();
            this.loadFurnRetirements();
            this.loadProducts();
            this.resetNewProduct();
        },
        computed: {
            newRuleLenght: function() {
                return this.new_product.rule_lenght = this.new_product.height;
            },
            editingModalLenght: function() {
                return this.editingModal.rule_lenght = this.editingModal.height;
            },
            totalHeight: function () {
                let height = 0;
                this.products.forEach(function(item, i) {
                    height += item.height;
                });
                return +height.toFixed(2);
            },
            totalWidth: function () {
                let width = 0;
                this.products.forEach(function(item, i) {
                    width += item.width;
                });
                return +width.toFixed(2);
            },
            totalCount: function () {
                return this.products.length;
            },
            checkMetalFails: function () {
                let errors = 0;
                this.metal_retirements.forEach(item => {
                    if(parseInt(this.sumProductMetal(item)) > parseInt(this.sumMetalPartsLenght(item))){
                        errors++;
                    }
                });
                return errors;
            },
            checkFurnFails: function () {
                let errors = 0;
                this.furn_retirements.forEach(item => {
                    if(parseInt(this.sumProductFurn(item)) > parseInt(this.sumFurnPartsCount(item))){
                        errors++;
                    }
                });
                return errors;
            },
            checkMaterialFails: function () {
                let errors = 0;
                this.products.forEach(item => {
                   if(!item.enoughMaterial) errors++;
                });
                return errors;
            }
        },
        methods: {
            totalNewItem(item) {
                return +(eval(eval('this.new_product.'+item.depends)+item.dependsCount)*item.count).toFixed(2);
            },
            totalEditItem(item) {
                return +(eval(eval('this.editingModal.'+item.depends)+item.dependsCount)*item.count).toFixed(2);
            },
            sumProductMetal(item) {
                let metal = null;
                this.products.forEach(p => {
                    p.metal.forEach(m => {
                        if(item.id === m.id) metal += +m.pivot.count;
                    })
                });
                return metal ? +metal.toFixed(2) : 0;
            },
            sumProductFurn(item) {
                let furn = null;
                this.products.forEach(p => {
                    p.furn.forEach(m => {
                        if(item.id === m.id) furn += +m.pivot.count;
                    })
                });
                return furn ? +furn.toFixed(2) : 0;
            },
            sumMetalPartsLenght(item) {
                let lenght = 0;
                item.metal.parts.forEach(function(part, i) {
                    lenght += part.lenght;
                });
                return +lenght.toFixed(2);
            },
            sumFurnPartsCount(item) {
                let count = 0;
                item.furn.parts.forEach(function(part, i) {
                    count += part.count;
                });
                return +count.toFixed(2);
            },
            loadMaterials(){
                axios.post('/admin/storage/roll/getAll')
                    .then((response) => {
                        this.materials = response.data;
                    });
            },
            loadProducts(){
                this.isBusy = true;
                axios.post('/admin/roll_products/getAll', {
                    order_id: this.order.id,
                })
                    .then((response) => {
                        this.products = response.data;
                        this.loadMaterials();
                        this.products.slice().reverse().forEach(item => this.writeOffMaterial(item));
                        this.isBusy = false;
                    });
            },
            loadRules(){
                axios.post('/admin/other/rule_types/get')
                    .then((response) => {
                        this.rule_types = response.data;
                        this.rule_types.splice(2,1);
                    });
            },
            loadComplectations(){
                axios.post('/admin/other/complectations_types/get')
                    .then((response) => {
                        this.complectation_types = response.data;
                    });
            },
            loadFurnColors(){
                axios.post('/admin/other/furn_colors/get')
                    .then((response) => {
                        this.furn_colors = response.data;
                    });
            },
            loadOrderStatuses(){
                axios.post('/admin/other/order_statuses/get')
                    .then((response) => {
                        this.order_statuses = response.data;
                    });
            },
            addProduct(){
                this.actionLoad = true;
                this.setNewAdditional();
                axios.post('/admin/roll_products', {
                    product: this.new_product,
                    count: this.new_product_count,
                    additional_metal: this.product_additional_metal,
                    additional_furn: this.product_additional_furn,
                })
                    .then(response => {
                        // this.products.push(response.data);
                        this.unsetAdditional();
                        this.loadProducts();
                        this.actionLoad = false;
                        this.$refs['modalAdd'].hide();
                        this.makeToast('Изделия успешно добавлены', 'success');
                        this.resetNewProduct();
                    });
            },
            editProduct() {
                this.actionLoad = true;
                this.setEditAdditional();
                axios.put('/admin/roll_products/'+this.editingModal.product_id, {
                    product: this.editingModal,
                    additional_metal: this.product_additional_metal,
                    additional_furn: this.product_additional_furn,
                })
                    .then((response) => {
                        this.unsetAdditional();
                        this.loadProducts();
                        this.actionLoad = false;
                        this.$bvModal.hide(this.editingModal.id);
                        this.makeToast('Данные изделия успешно сохранены', 'success');
                    });
            },
            setNewAdditional() {
                this.metal_retirements.forEach(item => {
                    this.product_additional_metal[item.id] = {
                        count: this.totalNewItem(item),
                    }
                });
                this.furn_retirements.forEach(item => {
                    this.product_additional_furn[item.id] = {
                        count: this.totalNewItem(item),
                    }
                });
            },
            setEditAdditional() {
                this.metal_retirements.forEach(item => {
                    this.product_additional_metal[item.id] = {
                        count: this.totalEditItem(item),
                    }
                });
                this.furn_retirements.forEach(item => {
                    this.product_additional_furn[item.id] = {
                        count: this.totalNewItem(item),
                    }
                });
            },
            unsetAdditional() {
                this.product_additional_metal = {};
                this.product_additional_furn = {};
            },
            resetNewProduct(){
                this.new_product = {
                    order_id: this.order.id,
                    type_id: this.order.product_type_id,
                    construction_id: this.order.construction_type_id,
                    rule_lenght: null,
                    rule_type_id: null,
                    complectation_type_id: 1,
                    material_id: null,
                    furn_color_id: null,
                    chain_lock: false,
                    chain_tensioner: false,
                    fishing_line: false,
                    magnets: false,
                    without_drilling: false,
                    note: '',
                    count: 1,
                };
                this.new_product_count = 1;
            },
            deleteModal(id) {
                this.deletingModal.product_id = id;
                this.$root.$emit('bv::show::modal', this.deletingModal.id);
            },
            deleteProduct(id){
                this.actionLoad = true;
                axios.delete('/admin/roll_products/'+id)
                    .then((response) => {
                        this.loadProducts();
                        this.actionLoad = false;
                        this.$bvModal.hide(this.deletingModal.id);
                        this.deletingModal.product_id = null;
                        this.makeToast('Изделия успешно удалены', 'danger');
                    });
            },
            editModal(item) {
                this.editingModal.product_id = item.id;
                this.editingModal.width = item.width;
                this.editingModal.height = item.height;
                this.editingModal.order_id = item.order_id;
                this.editingModal.construction_id = item.construction_id;
                this.editingModal.rule_lenght = item.rule_lenght;
                this.editingModal.rule_type_id = item.rule_type_id;
                this.editingModal.complectation_type_id = item.complectation_type_id;
                this.editingModal.material_id = item.material_id;
                this.editingModal.furn_color_id = item.furn_color_id;
                this.editingModal.chain_lock = item.chain_lock;
                this.editingModal.chain_tensioner = item.chain_tensioner;
                this.editingModal.fishing_line = item.fishing_line;
                this.editingModal.magnets = item.magnets;
                this.editingModal.without_drilling = item.without_drilling;
                this.editingModal.note = item.note;
                this.$root.$emit('bv::show::modal', this.editingModal.id);
            },
            changeStatus(status) {
                this.statusChanging = true;
                if(this.order.status_id !== 1 && (this.checkMetalFails > 0 || this.checkFurnFails > 0 || this.checkMaterialFails > 0)) {
                    this.makeToast('Не хватает материала на складе', 'danger');
                    this.statusChanging = false;
                }
                else {
                    if(this.order.status_id === 2) {
                        this.writeOffMetal();
                        this.writeOffFurn();
                    }
                    axios.put('/admin/orders/' + this.order.id, {
                        order: {
                            status_id: status
                        }
                    })
                        .then(response => {
                            this.order = response.data;
                            this.makeToast('Статус заказа успешно изменен', 'success');
                            this.statusChanging = false;
                        })
                }
            },
            writeOffMetal() {
                // metal
                this.metal_retirements.forEach((item, i) => {
                    let total = this.totalItem(item);
                    axios.post('/admin/storage/metal_actions', {
                        action: {
                            metal_storage_id: item.metal.id,
                            type_id: 2,
                            user_id: this.order.diller_id,
                            reason: 'Заказ №' + this.order.id,
                            lenght: total,
                        }
                    });
                    for (let p = 0; p < item.metal.parts.length; p++) {
                        if (item.metal.parts[p].lenght > total) {
                            item.metal.parts[p].lenght = +(item.metal.parts[p].lenght - total).toFixed(2);
                            axios.put('/admin/storage/metal_parts/' + item.metal.parts[p].id, {
                                part: {
                                    lenght: item.metal.parts[p].lenght,
                                }
                            });
                            break;
                        } else if (item.metal.parts[p].lenght === total) {
                            axios.delete('/admin/storage/metal_parts/' + item.metal.parts[p].id)
                                .then(delete (item.metal.parts[p]));
                            break;
                        } else { //if(item.metal.parts[p] < total) {
                            total = +(total - item.metal.parts[p].lenght).toFixed(2);
                            axios.delete('/admin/storage/metal_parts/' + item.metal.parts[p].id)
                                .then(delete (item.metal.parts[p]));
                        }
                    }
                });
            },
            writeOffFurn() {
                // furn
                this.furn_retirements.forEach((item, i) => {
                    let total = this.totalItem(item);
                    axios.post('/admin/storage/furn_actions', {
                        action: {
                            furn_storage_id: item.furn.id,
                            type_id: 2,
                            user_id: this.order.diller_id,
                            reason: 'Заказ №'+this.order.id,
                            count: total,
                        }
                    });
                    for(let p = 0; p < item.furn.parts.length; p++) {
                        if(item.furn.parts[p].count > total) {
                            item.furn.parts[p].count = +(item.furn.parts[p].count - total).toFixed(2);
                            axios.put('/admin/storage/furn_parts/'+item.furn.parts[p].id, {
                                part: {
                                    count: item.furn.parts[p].count,
                                }
                            });
                            break;
                        }
                        else if(item.furn.parts[p].count === total) {
                            axios.delete('/admin/storage/furn_parts/'+item.furn.parts[p].id)
                                .then(delete(item.furn.parts[p]));
                            break;
                        }
                        else { //if(item.metal.parts[p] < total) {
                            total = +(total - item.furn.parts[p].count).toFixed(2);
                            axios.delete('/admin/storage/furn_parts/'+item.furn.parts[p].id)
                                .then(delete(item.furn.parts[p]));
                        }
                    }
                });
            },
            writeOffMaterial(product) {
                let material = this.materials.find(item => item.id === product.material.id);
                let filteredParts = material.parts.filter(part => {
                    return part.width >= product.width && part.lenght >= product.height ? part : null;
                });
                if(filteredParts.length) {
                    let result = filteredParts.reduce(function(res, obj) {
                        return (obj.width*obj.lenght < res.width*res.lenght) ? obj : res;
                    });
                    result.width = result.lenght = 0;
                    product.enoughMaterial = Boolean(result);
                }
            },
            loadMetalRetirements() {
                axios.post('/admin/other/metal_retirements/getAll', {
                    type_id: this.order.product_type_id,
                    construction_id: this.construction_type_id,
                })
                    .then((response) => {
                        this.metal_retirements = response.data;
                    })
            },
            loadFurnRetirements() {
                axios.post('/admin/other/furn_retirements/getAll', {
                    type_id: this.order.product_type_id,
                    construction_id: this.order.construction_type_id,
                })
                    .then((response) => {
                        this.furn_retirements = response.data;
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
            },

        }
    }
</script>

<style scoped>

</style>
