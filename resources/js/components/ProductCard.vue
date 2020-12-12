<template>
    <div @click="linkHref" class="product-card-box mt-3">
        <div class="card">
            <canvas ref="can_img"></canvas>
<!--            <img :src="image" class="card-img-top" :alt="title">-->
            <div class="card-body">
                <h5 class="card-title"> <slot></slot> </h5>
                <p class="card-text">{{shortDesc}}</p>
                <p class="product-price">
                    {{price}} {{currency}}
                </p>
                <!-- /.product-price -->
                <a :href="link+'.html'" class="btn btn-primary">Деталі</a>
            </div>
        </div>
    </div>
    <!-- /.product-card-box -->
</template>

<script>
    export default {
        props: ['image', 'price', 'currency', 'description', 'link'],
        computed:{
            shortTitle(){
                let title = this.$slots.default[0].text.trim()
                if (title.length > 21){
                    title = title.slice(0, 19) + '...'
                }
                return title
            },
            shortDesc(){
                let desc = ''
                // if (this.$props.description){
                //     desc = this.$props.description.slice(0, 32) + '...'
                // }
                return desc
            }
        },
        methods:{
            drawImage(src){
                const can = this.$refs.can_img;
                const ctx = can.getContext('2d')
                const image = new Image()
                const div = 1.4
                can.height = 300/div
                can.width = 300
                image.onload = function(){
                    // TODO Фориуда розрахунку ширини зображення
                    ctx.drawImage(image, 0, 0, 300, 300/div)
                }
                image.src = src
            },
            linkHref(){
                console.log('Go to', this.$props.link)
                window.location.href = this.$props.link
            }
        },
        mounted() {
            this.drawImage(this.$props.image)
        }
    }
</script>

<style scoped lang="scss">
    .product-price{
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
    }
    .product-card-box{
        cursor: pointer;
        transition: all 0.5s;
        &:hover{
            -webkit-box-shadow: 0px 9px 24px -7px rgba(0,0,0,0.75);
            -moz-box-shadow: 0px 9px 24px -7px rgba(0,0,0,0.75);
            box-shadow: 0px 9px 24px -7px rgba(0,0,0,0.75);
            transition: all 0.5s;
        }
    }
</style>
