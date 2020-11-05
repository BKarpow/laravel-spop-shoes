<template>
    <div>
        <info-block title="Нові замовлення" @click-block="click" v-if="!showList">
            {{countOrders}}
        </info-block>
        <div class="list-all-new" v-if="showList">
            <button type="button" class="btn btn-primary my-2 btn-block" @click="click">Сховати</button>
            <ul class="list-group">
                <li
                    class="list-group-item"
                    v-for="order in ordersNew"
                    :key="order.id"
                    @click="selectOrder(order.id)"
                >
                    {{order.title + ': ' + order.user_phone}}
                </li>
            </ul>
        </div>
        <!-- /.list-all-new -->
    </div>
</template>

<script>
    const config = {
        url: {
            getNew: '/admin/ajax/order/get/all/new',
            orderID: '/admin/order/'
        },
    }
    export default {
        data(){
            return {
                ordersNew: [],
                showList: false
            }
        },
        methods:{
            fetchOrders(){
                axios.get(config.url.getNew)
                .then(resp => {
                    this.ordersNew = resp.data.data
                })
            },
            click(){
                console.log('Click order')
                this.showList = !this.showList
            },
            selectOrder(order_id){
                console.log(order_id)
                window.location.href = config.url.orderID + Number(order_id)
            }
        },
        computed:{
            countOrders(){
                return this.ordersNew.length
            }
        },
        mounted() {
            this.fetchOrders()
        }
    }
</script>

<style scoped lang="scss">
$bg: #383838;
$color: #afafaf;
li{
    cursor: pointer;
    transition: all .8s;
    &:hover{
        background: $bg;
        color: $color;
        transition: all .8s;
    }
}
</style>
