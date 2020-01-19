<template>
    <div>
        <h2 class="mb-4">Заказ</h2>
        <b-card no-body>
            <b-tabs card>
                <b-tab title="Общая информация" active>
                    <b-card-text>
                        <dl class="row">
                            <dt class="col-sm-3">№ заказа:</dt>
                            <dd class="col-sm-9">{{ order.id }}</dd>

                            <dt class="col-sm-3">Заказчик:</dt>
                            <dd class="col-sm-9"><a :href="`/admin/users/${order.diller.id}`">{{ order.diller.alias }}</a></dd>

                            <dt class="col-sm-3">Префикс:</dt>
                            <dd class="col-sm-9">{{ order.prefix }}</dd>

                            <dt class="col-sm-3">Вид изделий:</dt>
                            <dd class="col-sm-9">{{ order.product_type.label }} <span v-if="order.construction_type_id">{{ order.construction_type.label }}</span></dd>

                            <dt class="col-sm-3">Создан:</dt>
                            <dd class="col-sm-9">{{ order.created_at }}</dd>

                            <dt class="col-sm-3">Дата готовности:</dt>
                            <dd class="col-sm-9">28.09.2019</dd>

                            <dt class="col-sm-3">Примечание заказчика:</dt>
                            <dd class="col-sm-9">{{ order.diller_msg }}</dd>
                        </dl>
                    </b-card-text>
                </b-tab>
                <b-tab title="Изделия">
                    <b-card-text>
                        <order-roll-mini :order="order" ></order-roll-mini>
                    </b-card-text>
                </b-tab>
            </b-tabs>
        </b-card>
    </div>
</template>

<script>
    import OrderRollMini from './OrderRollMiniComponent.vue';
    export default {
        name: "OrderSingleComponent",
        components: { OrderRollMini },
        props:['id'],
        data() {
            return {
                order: [],
            }
        },
        created() {
            this.loadOrder();
        },
        methods: {
            loadOrder() {
                axios.post('/admin/orders/get/'+this.id)
                    .then((response) => {
                        this.order = response.data;
                    })
            },
        }
    }
</script>

<style scoped>

</style>
