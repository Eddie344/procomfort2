<template>
    <div>
        <form class="mb-3">
            <div class="form-row">
                <div class="col-sm-3">
                    <select class="form-control" v-model="catalog_selected">
                        <option :value="null" disabled selected>Выберите каталог...</option>
                        <option v-for="c in catalogs" v-bind:value="c.id">{{ c.label }}</option>
                    </select>
                </div>
                <div class="col-sm-3"  v-if="catalog_selected">
                    <button class="btn btn-info mr-3" type="submit" :disabled="loading" v-on:click="load">
                        <span v-if="!loading">Загрузить</span>
                        <div class="spinner-border spinner-border-sm" role="status" v-if="loading">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </button>
                </div>
            </div>
        </form>
<!--        <div v-show="tableLoaded">-->
<!--            <div class="row">-->
<!--                <form class="form-inline">-->
<!--                    <div class="form-group mb-2">-->
<!--                        <label for="staticEmail2" class="sr-only">Email</label>-->
<!--                        <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="email@example.com">-->
<!--                    </div>-->
<!--                    <div class="form-group mx-sm-3 mb-2">-->
<!--                        <label for="inputPassword2" class="sr-only">Password</label>-->
<!--                        <input type="password" class="form-control" id="inputPassword2" placeholder="Password">-->
<!--                    </div>-->
<!--                    <button type="submit" class="btn btn-primary mb-2">Confirm identity</button>-->
<!--                </form>-->
<!--                <form @submit.prevent="addRow" class="input-group mb-3 col-md-4">-->
<!--                    <input type="number" step="0.01" class="form-control" placeholder="Введите высоту" v-model="newRow" required>-->
<!--                    <div class="input-group-append">-->
<!--                        <button class="btn btn-success" type="submit">Добавить строку</button>-->
<!--                    </div>-->
<!--                </form>-->
<!--                <form @submit.prevent="addColumn" class="input-group mb-3 col-md-4">-->
<!--                    <input type="number" step="0.01" class="form-control" placeholder="Введите ширину" v-model="newColumn" required>-->
<!--                    <div class="input-group-append">-->
<!--                        <button class="btn btn-success" type="submit">Добавить колонку</button>-->
<!--                    </div>-->
<!--                </form>-->
<!--            </div>-->
<!--            <table class="table table-bordered" id="mtable">-->
<!--                <caption v-show="!Object.keys(prices).length">Таблица пуста. Сначала добавьте высоту</caption>-->
<!--                <thead>-->
<!--                <tr>-->
<!--                    <th scope="col" rowspan="2">Высота</th>-->
<!--                    <th scope="row" colspan="11">Ширина</th>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th class="price-col"  v-for="width in widths">{{ width }} <button class="btn btn-link text-danger delete-item" v-on:click="deleteColumn(width)">&times;</button></th>-->
<!--                </tr>-->
<!--                </thead>-->
<!--                <tbody>-->
<!--                <tr v-for="(h, key) in prices">-->
<!--                    <th class="price-row">{{ key }} <button class="btn btn-link text-danger delete-item" v-on:click="deleteRow(key)">&times;</button></th>-->
<!--                    <td v-for="w in h">-->
<!--                        <input type="number" step="0.01" class="form-control" v-model="w.price">-->
<!--                    </td>-->
<!--                </tr>-->
<!--                </tbody>-->
<!--            </table>-->
<!--            <form @submit.prevent="save">-->
<!--                <div class="d-flex">-->
<!--                    <button class="btn btn-info mr-3" type="submit" :disabled="alertSaved">-->
<!--                        <span v-if="!alertSaved">Сохранить</span>-->
<!--                        <span v-if="alertSaved">Изменения сохранены</span>-->
<!--                        <div class="spinner-border spinner-border-sm" role="status" v-if="btnLoading">-->
<!--                            <span class="sr-only">Loading...</span>-->
<!--                        </div>-->
<!--                    </button>-->
<!--                </div>-->
<!--            </form>-->
<!--        </div>-->
    </div>
</template>

<script>
    export default {
        name: "SimplePriceComponent",
        props:[
            'type'
        ],
        data: function () {
            return {
                catalog_selected: null,
                catalogs: [],
            }
        },
        mounted(){
            this.getCatalogs();
        },
        methods:{
            getCatalogs(){
                axios.post('/admin/other/catalogs/get')
                    .then((response) => {
                        this.catalogs = response.data;
                    });
            }
        },
    }
</script>

<style scoped>

</style>
