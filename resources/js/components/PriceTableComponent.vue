<template>
    <div>
        <div class="row">
            <form @submit.prevent="addRow" class="input-group mb-3 col-md-4">
                <input type="number" class="form-control" placeholder="Введите длину" v-model="newRow">
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit">Добавить строку</button>
                </div>
            </form>
            <form @submit.prevent="addColumn" class="input-group mb-3 col-md-4">
                <input type="number" class="form-control" placeholder="Введите ширину" v-model="newColumn">
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
                <th scope="col"  v-for="width in widthdata">{{ width }}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(price1, key) in heights">
                <th scope="row">{{ key }}</th>
                <td v-for="price2 in price1">
                    <input type="number" class="form-control" size="1" v-model="price2.price">
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "PriceTableComponent",
        props:{
            heightdata: Object,
            widthdata: Array,
        },
        data: function () {
            return {
                heights: [],
                newRow:'',
                newColumn:'',
            }
        },
        mounted(){
            this.setHeights()
        },
        methods:{
            setHeights: function() {
                console.log(this.heightdata.length);
                // for (let i = 0; i < this.heightdata.length; i++) {
                //     console.log(i);
                // }
            },
            update:function() {
                console.log(this.heightdata);
            },
            addRow(){
                // var row = this.heights[this.heights.length - 1];
                // Vue.set(this.heights, row);
                // var rowLength = JSON.parse(JSON.stringify(this.heights[1]));
                // var rowCopy = JSON.parse(JSON.stringify(this.heights[1]));
                // console.log(rowCopy);
                // //var rowCopy = this.heights[this.heights.length - 1];
                // Vue.set(this.heights, rowCopy);
            },
            addColumn(){

            },
        }
    }
</script>

<style scoped>

</style>
