<template>
    <div>
        <form class="mb-3">
            <div class="form-row">
                <div class="col-sm-3">
                    <select class="form-control" v-model="construction_selected">
                        <option :value="null" disabled selected>Выберите тип конструкции...</option>
                        <option v-for="c in constructions" v-bind:value="c.id">{{ c.label }}</option>
                    </select>
                </div>
                <div class="col-sm-3" v-if="construction_selected != null">
                    <select class="form-control" v-model="catalog_selected">
                        <option :value="null" disabled selected>Выберите каталог...</option>
                        <option v-for="c in catalogs" v-bind:value="c.id">{{ c.label }}</option>
                    </select>
                </div>
                <div class="col-sm-3" v-if="catalog_selected != null" v-on:change="load">
                    <select class="form-control" v-model="category_selected">
                        <option :value="null" disabled selected>Выберите категорию...</option>
                        <option v-for="c in categories" v-bind:value="c.id">{{ c.label }}</option>
                    </select>
                </div>
            </div>
        </form>
        <div v-show="category_selected && catalog_selected && construction_selected">
            <div class="row">
                <form @submit.prevent="addRow" class="input-group mb-3 col-md-4">
                    <input type="number" step="0.01" class="form-control" placeholder="Введите высоту" v-model="newRow" required>
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit">Добавить строку</button>
                    </div>
                </form>
                <form @submit.prevent="addColumn" class="input-group mb-3 col-md-4">
                    <input type="number" step="0.01" class="form-control" placeholder="Введите ширину" v-model="newColumn" required>
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit">Добавить колонку</button>
                    </div>
                </form>
            </div>
            <table class="table table-bordered" id="mtable">
                <thead>
                <tr>
                    <th scope="col" rowspan="2">Высота</th>
                    <th scope="row" colspan="11">Ширина</th>
                </tr>
                <tr>
                    <th class="price-col"  v-for="width in widths">{{ width }} <button class="btn btn-link text-danger delete-item" v-on:click="deleteColumn(width)">&times;</button></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(h, key) in prices">
                    <th class="price-row">{{ key }} <button class="btn btn-link text-danger delete-item" v-on:click="deleteRow(key)">&times;</button></th>
                    <td v-for="w in h">
                        <input type="number" step="0.01" class="form-control" v-model="w.price">
                    </td>
                </tr>
                </tbody>
            </table>
            <form @submit.prevent="save">
                <button class="btn btn-success" type="submit">Сохранить</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PriceTableComponent",
        props:[
            'constructions',
            'catalogs',
            'categories',
        ],
        data: function () {
            return {
                //menu
                construction_selected: null,
                catalog_selected: null,
                category_selected : null,
                //table
                prices: {},
                widths:[],
                newRow: '',
                newColumn: '',
            }
        },
        mounted(){
            this.getUniqWidths(this.prices);
        },
        methods:{
            addRow(){
                if(this.newRow) // если введено значение в поле
                {
                    let floatRow = this.getFloatValue(this.newRow); //создаем float из введенного значения
                    this.prices = {}; //превращаем массив в объект
                    this.prices[floatRow] = {}; //добавляем объект с ключом высоты
                    if(this.widths.length) //если массив с ширинами содержит значения
                    {
                        for(let key in this.widths) //перебираем массив с ширинами
                        {
                            this.prices[floatRow][this.widths[key]] = {
                                catalog_id: this.catalog_selected,
                                category_id: this.category_selected,
                                construction_id: this.construction_selected,
                                height: floatRow,
                                width: this.widths[key],
                                price: '0',
                            };
                        }
                    }
                    this.newRow = '';
                }
            },
            addColumn(){
                if(this.newColumn)
                {
                    let floatCol = this.getFloatValue(this.newColumn);
                    for(let key in this.prices){
                        this.prices[key][floatCol] = {
                            catalog_id: this.catalog_selected,
                            category_id: this.category_selected,
                            construction_id: this.construction_selected,
                            height: key,
                            width: floatCol,
                            price: '0',
                        };
                    }
                    this.newColumn = '';
                    this.getUniqWidths(this.prices);
                }
            },
            deleteRow(key) {
                if(Object.keys(this.prices).length > 1 || !Object.keys(this.widths).length){
                    Vue.delete(this.prices, key);
                }
            },
            deleteColumn(key){
                for(let row in this.prices) {
                    Vue.delete(this.prices[row], key);
                }
                this.getUniqWidths(this.prices);
            },
            getUniqWidths(obj){
                this.widths=[];
                for (let key in obj) {
                    let heights = Object.keys(obj[key]);
                    Object.assign(this.widths, heights);
                }
                this.widths = JSON.parse(JSON.stringify(this.widths));
            },
            getFloatValue(val){
                if(Number.isInteger(+val)){
                    return parseInt(val).toFixed(1);
                }
                else {
                    return val;
                }
            },
            save(){
                axios.put('/admin/price/roll/update', {
                    prices: this.prices,
                    construction_id: this.construction_selected,
                    catalog_id: this.catalog_selected,
                    category_id: this.category_selected
                })
                .then((response) => {
                    console.log(response);
                })
                .catch((error) => {
                    console.log(error);
                });
            },
            load(){
                axios.post('/admin/price/roll/get', {
                    construction_id: this.construction_selected,
                    catalog_id: this.catalog_selected,
                    category_id: this.category_selected
                })
                .then((response) => {
                    this.prices = response.data;
                    this.getUniqWidths(this.prices);
                });
            }
        }
    }
</script>

<style lang="sass" scoped>
    .price-row,.price-col
        position: relative
        &:hover
            .delete-item
                display: block

    .delete-item
        display: none
        padding: 0
        font-size: 24px
        position: absolute
        top: -2px
        right: 3px
</style>
