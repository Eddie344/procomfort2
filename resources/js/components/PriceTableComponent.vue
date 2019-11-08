<template>
    <div>
        <div class="row">
            <form @submit.prevent="addRow" class="input-group mb-3 col-md-4">
                <input type="number" step="0.01" class="form-control" placeholder="Введите длину" v-model="newRow" required>
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit">Добавить строку</button>
                </div>
            </form>
            <form @submit.prevent="addColumn" class="input-group mb-3 col-md-4" v-if="Object.keys(prices).length">
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
                <th scope="col"  v-for="width in widths">{{ width }}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(h, key) in prices">
                <th scope="row">{{ key }}</th>
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
</template>

<script>
    export default {
        name: "PriceTableComponent",
        props:{
            pricedata: Object,
        },
        data: function () {
            return {
                prices: this.pricedata,
                widths:[],
                newRow:'',
                newColumn:'',
            }
        },
        mounted(){
            this.getUniqWidths(this.prices);
            this.prices = Object.assign({}, this.prices);
        },
        methods:{
            update:function() {
                console.log(this.pricedata);
            },
            addRow(){
                if(this.newRow)
                {
                    this.prices[this.newRow] = {};
                    if(this.widths.length)
                    {
                        for(let key in this.widths)
                        {
                            this.prices[this.newRow][this.widths[key]] = {
                                catalog_id: 1,
                                category_id: 1,
                                construction_id: 1,
                                height: this.newRow,
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
                    let floatCol = parseInt(this.newColumn).toFixed(1)
                    for(let key in this.prices){
                        this.prices[key][floatCol] = {
                            catalog_id: 1,
                            category_id: 1,
                            construction_id: 1,
                            height: key,
                            width: this.newColumn,
                            price: '0',
                        };
                    }
                    this.newColumn = '';
                    this.getUniqWidths(this.prices);
                }
            },
            getUniqWidths(obj){
                for (let key in obj) {
                    let heights = Object.keys(obj[key]);
                    Object.assign(this.widths, heights);
                }
                this.widths = JSON.parse(JSON.stringify(this.widths));
            },
            save(){

                axios.put('/admin/price/roll/update', this.prices)
                .then((response) => {
                    console.log(response);
                })
                .catch((error) => {
                    console.log(error);
                });
            }
        }
    }
</script>

<style scoped>

</style>
