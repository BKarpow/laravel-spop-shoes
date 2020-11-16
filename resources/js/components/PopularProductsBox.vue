<template>
    <div class="products-box">
        <div class="container">
            <div class="row flex-wrap">
                <div class="col-md-3" v-for="product in products" :key="product.id">
                    <product-card
                        :price="product.price"
                        currency="грн."
                        :image="product.main"
                        :description="product.description"
                        :link=" '/product/'+ product.id +'-' + product.alias "
                    >
                        {{product.title}}
                    </product-card>
                </div>
                <!-- /.col-md-3 -->
                <div class="col-md-12 mt-3 align-self-end">
                    <button @click="nextPage" type="button" class="btn btn-secondary btn-lg">
                        {{buttonText}}
                        <i class="fas fa-angle-double-right"></i>
                    </button>
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->

    </div>
    <!-- /.products-box -->
</template>

<script>
const config = {
    url_ajax: '/ajax/product/popular',
    text:{
        buttonNext: 'Ще 4 товара',
        buttonBack: 'Ще 4 товара'
    }
}
export default {
    props: ['ajaxUrl'],
    data(){
        return {
            products: [],
            buttonText: config.text.buttonNext,
            lastPage: 1,
            countPage: 0,
            currentPage: 1,
            rowBack: false
        }
    },

    methods:{
        fetchProducts(page = null){
            page = (page) ? '?page=' + page : ''
            // TODO Помінять метод на пост
            axios.get(this.$props.ajaxUrl + page).then(resp => {
                const data = resp.data.data
                const info = resp.data
                this.products = data

                this.countPage = Math.ceil(Number(info.total) / Number(info.per_page))
                this.currentPage = info.current_page
                this.lastPage = resp.data.last_page
            })
        },
        nextPage(){
            if (this.countPage === this.currentPage){
                this.buttonText = config.text.buttonBack
                this.rowBack = true
                this.fetchProducts(1)
            }else{
                this.buttonText = config.text.buttonNext
                this.rowBack = false
                this.fetchProducts(this.lastPage)
            }

        }
    },

    mounted() {
        this.fetchProducts()
    }
}
</script>
