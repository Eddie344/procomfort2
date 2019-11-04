<template>
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
        <tr v-for="(price1, key) in heightdata">
            <td>{{ key }}</td>
            <td contenteditable  v-for="price2 in price1">
                {{ price2.price }}
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props:[
            'heightdata',
            'widthdata',
        ],
        name: "PriceTableComponent",
        mounted(){
            this.update()
        },
        methods:{
            update:function() {
                console.log(this.heightdata);
            }
        }
    }
</script>

<style scoped>

</style>
