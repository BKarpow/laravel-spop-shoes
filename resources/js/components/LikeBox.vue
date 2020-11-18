<template>
    <div id="like-box" class="my-2">
        <div class="alert my-1 alert-info" v-if="info.length">
            <strong>{{info}}</strong>
        </div>
        <!-- /.alert -->
        <div class="like">
            <span class="bt-like" @click="clickLike">
                <i class="fas fa-thumbs-up"></i>
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
export default {
    props: ['productId', 'auth'],
    data(){
        return {
            numberLike: 0,
            info: ''
        }
    },
    methods:{
        fetchInfo(){
            axios.post('/ajax/like/get/', {pid: this.$props.productId})
            .then(r => {
                const d = r.data.data
                if (d){
                    this.numberLike = d.likes
                }
            })
        },
        clickLike(){

        }
    },
    mounted() {
        this.fetchInfo()
    }
}
</script>

<style scoped lang="scss">
    .like{
        font-size: 2rem;
        display: flex;
        span{
            display: block;
            width: 3rem;
            padding-right: 1rem ;
        }
    }
</style>
