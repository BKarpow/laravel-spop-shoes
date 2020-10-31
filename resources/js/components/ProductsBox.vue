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
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->

    </div>
    <!-- /.products-box -->
</template>

<script>
    export default {
        data(){
            return {
                products: []
            }
        },

        methods:{
            fetchProducts(){
                // TODO Помінять метод на пост
                axios.get('/ajax/product/new').then(reso => {
                    const data = reso.data.data
                    this.products = data
                })
            }
        },

        mounted() {
            this.fetchProducts()
        }
    }
</script>
