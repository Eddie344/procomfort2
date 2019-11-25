<template>
    <div>
        <b-form inline class="mb-3">
            <b-button class="mr-3" variant="success" v-b-modal.modalAddPrice><strong>+</strong></b-button>

            <b-modal ref="modalAddPrice" id="modalAddPrice" size="sm" title="Добавление" hide-footer centered>
                <b-form @submit.prevent="addItem">
                    <b-form-group label="Наименование:">
                        <b-form-input type="text" v-model="new_item.label" required></b-form-input>
                    </b-form-group>
                    <b-form-group label="Каталог:">
                        <b-form-select
                            v-model="new_item.catalog_id"
                            :options="catalogs"
                            class="mb-3"
                            value-field="id"
                            text-field="label"
                        >
                            <template v-slot:first>
                                <option :value="null" disabled selected>Выберите каталог...</option>
                            </template>
                        </b-form-select>
                    </b-form-group>
                    <b-form-group label="Категория:">
                        <b-form-select
                            v-model="new_item.category_id"
                            :options="categories"
                            class="mb-3"
                            value-field="id"
                            text-field="label"
                        >
                            <template v-slot:first>
                                <option :value="null" disabled selected>Выберите категорию...</option>
                            </template>
                        </b-form-select>
                    </b-form-group>
                    <b-form-group label="Направление рисунка:">
                        <b-form-select
                            v-model="new_item.picture_id"
                            :options="pictures"
                            class="mb-3"
                            value-field="id"
                            text-field="label"
                        >
                            <template v-slot:first>
                                <option :value="null" disabled selected>Выберите направление рисунка...</option>
                            </template>
                        </b-form-select>
                    </b-form-group>
                    <b-button variant="primary" type="submit">Добавить</b-button>
                </b-form>
            </b-modal>
        </b-form>
        <b-table
            id="my-table"
            :items="items"
            :fields="fields"
            :per-page="perPage"
            :current-page="currentPage"
            :striped="true"
        >
        </b-table>
        <b-pagination
            v-model="currentPage"
            :total-rows="rows"
            :per-page="perPage"
            aria-controls="my-table"
        ></b-pagination>
<!--        <div class="input-group mb-3">-->
<!--            <button type="button" class="btn btn-success mr-3" data-toggle="modal" data-target="#exampleModalCenter">-->
<!--                Добавить +-->
<!--            </button>-->

<!--            &lt;!&ndash; Modal &ndash;&gt;-->
<!--            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">-->
<!--                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">-->
<!--                    <div class="modal-content">-->
<!--                        <div class="modal-header">-->
<!--                            <h5 class="modal-title" id="exampleModalLongTitle">Добавление пункта</h5>-->
<!--                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                                <span aria-hidden="true">&times;</span>-->
<!--                            </button>-->
<!--                        </div>-->
<!--                        {{ Form::open(['route' => 'roll.store']) }}-->
<!--                        {{ Form::token() }}-->
<!--                        <div class="modal-body">-->
<!--                            <div class="form-group">-->
<!--                                {{ Form::label('label', 'Наименование:') }}-->
<!--                                {{ Form::text('label', null, ['class' => 'form-control', 'required']) }}-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                {{ Form::label('catalog_id', 'Каталог:') }}-->
<!--                                {{ Form::select('catalog_id', \App\Models\Catalog::pluck('label','id'), null, ['placeholder' => 'Выберите каталог...', 'class' => 'form-control', 'required'])}}-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                {{ Form::label('category_id', 'Категория:') }}-->
<!--                                {{ Form::select('category_id', \App\Models\RollCategory::pluck('label', 'id'), null, ['placeholder' => 'Выберите категорию...', 'class' => 'form-control', 'required'])}}-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                {{ Form::label('picture_id', 'Направление рисунка:') }}-->
<!--                                {{ Form::select('picture_id', \App\Models\RollPicture::pluck('label', 'id'), null, ['placeholder' => 'Выберите направление рисунка...', 'class' => 'form-control', 'required'])}}-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="modal-footer">-->
<!--                            {{ Form::submit('Добавить', ['class' => 'btn btn-primary']) }}-->
<!--                        </div>-->
<!--                        {{ Form::close() }}-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="dropdown">-->
<!--                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                    Фильтр-->
<!--                </button>-->
<!--                <div class="dropdown-menu p-3" style="width: 250px" aria-labelledby="dropdownMenuButton">-->
<!--                    {{ Form::open(['route' => 'roll.index', 'method' => 'get', 'class' => '']) }}-->
<!--                    <div class="form-group">-->
<!--                        {{ Form::label('label', 'Наименование:') }}-->
<!--                        {{ Form::text('label', Request::get('label'), ['class' => 'form-control'])}}-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        {{ Form::label('catalog', 'Каталог:') }}-->
<!--                        {{ Form::select('catalog', \App\Models\Catalog::pluck('label','id'), Request::get('catalog'), ['placeholder' => 'Все', 'class' => 'form-control'])}}-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        {{ Form::label('category', 'Категория:') }}-->
<!--                        {{ Form::select('category', \App\Models\RollCategory::pluck('label','id'), Request::get('category'), ['placeholder' => 'Все', 'class' => 'form-control'])}}-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        {{ Form::label('picture', 'Направление рисунка:') }}-->
<!--                        {{ Form::select('picture', \App\Models\RollPicture::pluck('label','id'), Request::get('picture'), ['placeholder' => 'Все', 'class' => 'form-control'])}}-->
<!--                    </div>-->
<!--                    {{ Form::submit('Применить', ['class' => 'btn btn-primary']) }}-->
<!--                    {{ Form::close() }}-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        @if (session('status'))-->
<!--        <div class="alert alert-{{ session('color') }} alert-dismissible col-md-6 fade show" role="alert">-->
<!--            {{ session('status') }}-->
<!--            <button type="button" class="close" data-dismiss="alert" aria-label="Close">-->
<!--                <span aria-hidden="true">&times;</span>-->
<!--            </button>-->
<!--        </div>-->
<!--        @endif-->
<!--        <table class="table table-striped">-->
<!--            <thead>-->
<!--            <tr>-->
<!--                <th scope="col">Наименование</th>-->
<!--                <th scope="col">Каталог</th>-->
<!--                <th scope="col">Категория</th>-->
<!--                <th scope="col">Направление рисунка</th>-->
<!--                <th scope="col">Действия</th>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--            @foreach ($rolls as $roll)-->
<!--            <tr>-->
<!--                <td><a href="{{ route('roll.show', ['id' => $roll->id]) }}">{{ $roll->label }}</a></td>-->
<!--                <td>{{ $roll->catalog->label }}</td>-->
<!--                <td>{{ $roll->category->id }}</td>-->
<!--                <td>{{ $roll->picture->label }}</td>-->
<!--                <td>-->
<!--                    <a href="" data-toggle="modal" data-target={{ '#modalDelete'.$roll->id }}><h5 class="d-inline"><i class="fa fa-trash-o text-danger"></i></h5></a>-->
<!--                    <div class="modal fade" id={{ 'modalDelete'.$roll->id }} tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">-->
<!--                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">-->
<!--                        <div class="modal-content">-->
<!--                            {{ Form::open(['route' => ['roll.destroy' , $roll->id], 'method' => 'delete']) }}-->
<!--                            {{ Form::token() }}-->
<!--                            <div class="modal-header">-->
<!--                                <h5 class="modal-title" id="exampleModalLongTitle">Вы уверены?</h5>-->
<!--                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                                    <span aria-hidden="true">&times;</span>-->
<!--                                </button>-->
<!--                            </div>-->
<!--                            <div class="modal-footer">-->
<!--                                {{ Form::submit('Удалить', ['class' => 'btn btn-danger']) }}-->
<!--                            </div>-->
<!--                            {{ Form::close() }}-->
<!--                        </div>-->
<!--                    </div>-->
<!--    </div>-->
<!--    </td>-->
<!--    </tr>-->
<!--    @endforeach-->
<!--    </tbody>-->
<!--    </table>-->
<!--    {{ $rolls->links() }}-->
    </div>
</template>

<script>
    export default {
        name: "ListStorageComponent",
        data() {
            return {
                perPage: 10,
                currentPage: 1,
                fields: [
                    {
                        key: 'label',
                        label: 'Наименование',
                    },
                    {
                        key: 'catalog.label',
                        label: 'Каталог',
                        sortable: true
                    },
                    {
                        key: 'category.label',
                        label: 'Категория',
                        sortable: true
                    },
                    {
                        key: 'picture.label',
                        label: 'Направление рисунка',
                        sortable: true
                    },
                ],
                items: [],
                categories: [],
                catalogs: [],
                pictures: [],
                new_item: {},
            }
        },
        computed: {
            rows() {
                return this.items.length
            }
        },
        mounted() {
            this.getCatalogs();
            this.getCategories();
            this.getPictures();
            this.load();
        },
        methods:{
            load(){
                axios.post('/admin/storage/roll/get')
                    .then((response) => {
                        this.items = response.data;
                    });
            },
            addItem(){
                axios.post('/admin/storage/roll', {
                    item: this.new_item
                })
                    .then((response) => {
                        console.log(response.data);
                        this.items.push(response.data);
                        this.new_item = {};
                    });
                //this.showAlert('success', 'Цена успешно добавлена');
                this.$refs['modalAddPrice'].hide();
            },
            getCategories(){
                axios.post('/admin/other/categories/roll/get')
                    .then((response) => {
                        this.categories = response.data;
                    });
            },
            getCatalogs(){
                axios.post('/admin/other/catalogs/get')
                    .then((response) => {
                        this.catalogs = response.data;
                    });
            },
            getPictures(){
                axios.post('/admin/other/picture_types/get')
                    .then((response) => {
                        this.pictures = response.data;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
