<template>
    <div id="like-box" class="my-2">
        <div class="alert my-1 alert-info" v-if="info.length">
            <strong>{{info}}</strong>
        </div>
        <!-- /.alert -->
        <div class="info">
            <slot></slot>
        </div>
        <div class="like">
            <span class="bt-like animate__animated" :class="{'active': isLike, 'animate__heartBeat':animate}" ref="icon" @click="clickLike">
                <i class="fa-heart" :class="{'far': !isLike, 'fas': isLike}"></i>
            </span>
            <!-- /.bt-like -->
            <span class="nb-like">{{numberLike}}</span>
            <!-- /.nb-like -->
        </div>
        <!-- /.like -->
    </div>
    <!-- /#like-box -->
</template>

<script>
const conf = {
    urls: {
        get: '/ajax/like/get/',
        plus:'/ajax/like/plus',
        minus:'/ajax/like/minus'
    },
    redirect: '/login',
    animateClass: 'animate__tada'
}
export default {
    props: ['productId', 'auth'],
    data(){
        return {
            numberLike: 0,
            isLike: false,
            info: '',
            likeUrl: conf.urls.plus,
            animate: false
        }
    },
    methods:{
        fetchInfo(){
            axios.post(conf.urls.get, {pid: this.$props.productId})
            .then(r => {
                const d = r.data.data
                if (d){
                    this.numberLike = Number( d.likes || 0)
                    this.isLike = d.isLike
                    if (d.isLike){
                        this.likeUrl = conf.urls.minus
                    }
                }
            })
        },
        clickLike(){
            if (this.$props.auth === '0'){
                window.location.href = conf.redirect
                return NaN;
            }
            axios.post(this.likeUrl, {pid: this.$props.productId})
            .then(resp => {
                const d = resp.data.data
                if (d){
                    this.fetchInfo()
                    this.likeUrl = conf.urls.plus
                    this.animate = true
                }
            })
        }
    },
    mounted() {
        this.fetchInfo()
    }
}
</script>

<style scoped lang="scss">
$activeBg: #e0245e;
    .like{
        font-size: 1.3rem;
        display: flex;
        span{
            display: block;
            width: 1.9rem;
            padding-right: .5rem ;
        }
        .bt-like{
            cursor: pointer;
        }
    }

    .active{
        color: $activeBg;
    }
</style>
