<template>
    <div id="cartRoot">
        <div id="cart-icon">
            <a href="" data-toggle="modal" data-target="#cart-body">
<!--                <div class="text-cart-title">Мій кошик</div>-->
                <!-- /.text-cart-title -->
            <i class="fas fa-shopping-cart"></i>
            <!-- /.fas fa-cart -->
            <span class="all-price">{{fullPrice}}</span>
            <!-- /.all-price -->
            </a>
        </div>
        <!-- /#cart-icon -->

        <div id="cart-body"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade">


            <!-- Modal -->
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Кошик</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card" v-for="item in dataCartItems">
                                <div class="card-header">
                                    {{item.title}}
                                </div>
                                <img :src="item.image" class="card-img-top" :alt="item.title">
                                <div class="card-body">
                                    <h5 class="card-title">{{item.title}}</h5>
                                    <p class="card-text">

                                        <h5>Цына {{item.price}}</h5>
                                    </p>
                                    <button type="button" @click="removeProduct(item.pid)" class="btn btn-danger">
                                        Видалити з кошика
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрити</button>
                            <button type="button" class="btn btn-primary">Купити {{fullPrice}}</button>
                        </div>
                    </div>
                </div>
        </div>
        <!-- /#cart-body -->
    </div>
    <!-- /#cartRoot -->
</template>

<script>
const conf = {
    currency: ' грн.',
    urls:{
        getCart:'/ajax/cart/get',
        remove:'/ajax/cart/remove',
    },
}
export default {
    props: ['trigger'],
    data(){
        return {
            trig: this.$props.trigger,
            allPrice: 0,
            currency: conf.currency,
            dataCartFull: {},
            dataCartItems: []
        }
    },
    watch:{
        trig(){
            this.fetchCart()
        }
    },
    computed:{
        fullPrice(){
            return this.allPrice + ' ' + this.currency
        }
    },
    methods:{
        fetchCart(){
            axios.post(conf.urls.getCart).then(resp => {
                const data = resp.data.data
                if (data.data.length){
                    this.dataCartFull = data
                    this.dataCartItems = data.data
                    this.sumAllPrice()
                }
            })
        },
        sumAllPrice(){
            let sum = 0
            if (this.dataCartItems.length){
                this.dataCartItems.forEach(item => {
                    if (item.price){
                        sum += Number(item.price)
                    }
                })
            }
            this.allPrice = sum
        },
        removeProduct(product_id){
            axios.post(conf.urls.remove, {pid: product_id}).then(resp => {
                const res = resp.data.data.delete
                if (res){
                    this.dataCartItems = this.dataCartItems.filter(i => {
                        if (i.pid === product_id){
                            return false
                        }else{
                            return true
                        }
                    })
                    this.sumAllPrice()
                    this.$emit('cart-product-remove', product_id)
                }
            }).catch(err => {console.error(err)})
        }
    },
    mounted() {
        this.$on('trigger', ()=>{
            console.log('Trigger on!!!')
        })
        this.fetchCart()
    }

}
</script>

<style scoped lang="scss">
$fontIconSize: 2rem;
a{
    color: inherit;
    text-decoration: none;
    &:hover{
        color: inherit;
        text-decoration: none;
    }
    i{
        font-size: $fontIconSize;
    }
    span{
        margin-right: 2rem;
        font-size: $fontIconSize;
        &:before{
            content: '\00A0\00A0';
        }
    }
}
</style>
