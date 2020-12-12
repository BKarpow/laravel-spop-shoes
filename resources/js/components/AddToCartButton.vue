<template>
    <div id="addCartButton">
        <button type="button"
                @click="addToCart"
                class="btn btn-block"
                :class="{'btn-dark': !existsProductCart, 'btn-outline-dark': existsProductCart}"
        >
           <i
               class="fas "
               :class="{'fa-shopping-cart': !existsProductCart, 'fa-check-circle': existsProductCart}"
           ></i> {{textButton}}
        </button>
        <!-- /.btn -->
    </div>
    <!-- /#addCartButton -->
</template>

<script>
const conf = {
    noProductCart: 'Додати до кошика',
    existsProductCart: 'Вже в кошику',
    urls:{
        check: '/ajax/cart/check',
        add: '/ajax/cart/add'
    }
}
export default {
    props: ['productId', 'auth'],
    data(){
        return {
            existsProductCart: false
        }
    },
    computed:{
        textButton(){
            return (this.existsProductCart) ? conf.existsProductCart : conf.noProductCart
        }
    },
    methods:{
        addToCart(){
            if (this.$props.auth === '0'){
                window.location.href = '/login'
                return
            }
            if (!this.existsProductCart){
                axios.post(conf.urls.add, {pid: this.$props.productId})
                    .then(r => {
                        const data = r.data.data
                        if (data){
                            this.existsProductCart = true
                            this.$emit('trigger', true)
                        }
                    }).catch(e=>{console.error(e)})
            }

        },
        check(){
            axios.post(conf.urls.check, {pid: this.$props.productId})
                .then(r => {
                    const data = r.data.data.check
                    if (data){
                        this.existsProductCart = true
                    }
                }).catch(e=>{console.error(e)})
        },
        rmFromCart(pid){
            if (Number(pid) === Number( this.$props.productId)){
                this.existsProductCart = false
            }
        },
    },
    mounted(){
        this.check()
    }
}
</script>
