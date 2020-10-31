<template>
    <div id="imageBox">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center">Додати зображення</h3>
                    <!-- /.text-center -->
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
            <div class="row flex-wrap">
                <div class="col-md-4">
                    <upload-block
                        upload-url="/admin/image/upload"
                        name-input="main_image"
                        @load-success="setPath"
                    >Головне зображення</upload-block>
                </div>
                <!-- /.col-md-4 -->
                <div class="col-md-4" v-if="!oneBox">
                    <upload-block
                        upload-url="/admin/image/upload"
                        name-input="image_a"
                    >Зображення А</upload-block>
                </div>
                <!-- /.col-md-4 -->
                <div class="col-md-4" v-if="!oneBox">
                    <upload-block
                        upload-url="/admin/image/upload"
                        name-input="image_b"
                    >Зображення B</upload-block>
                </div>
                <!-- /.col-md-4 -->
                <div class="col-md-4" v-if="!oneBox">
                    <upload-block
                        upload-url="/admin/image/upload"
                        name-input="image_c"
                    >Зображення C</upload-block>
                </div>
                <!-- /.col-md-4 -->
                <div class="col-md-4" v-if="!oneBox">
                    <upload-block
                        upload-url="/admin/image/upload"
                        name-input="image_d"
                    >Зображення D</upload-block>
                </div>
                <!-- /.col-md-4 -->
                <div class="col-md-4" v-if="!oneBox">
                    <upload-block
                        upload-url="/admin/image/upload"
                        name-input="image_e"
                    >Зображення E</upload-block>
                </div>
                <!-- /.col-md-4 -->
            </div>
            <!-- /.row flex-wrap -->
        </div>
        <!-- /.container -->
    </div>
</template>

<script>
    export default {
        props: ['uploadImageUrl', 'oneBox'],
        data(){
            return {
                imagesData: {
                    main_image: '',
                    image_a: '',
                    image_b: '',
                    image_c: '',
                    image_d: '',
                    image_e: '',
                },
            }
        },
        methods:{
            setPath(name_props, value){
                this.imagesData[name_props] = value
            },
            createImage(file, image_name){

            }
        }
    }
</script>

<style scoped>
    #imageBox{
        margin: 1rem;
        border: 1px solid #111;
        border-radius: 10px;
        padding: .5rem;
    }
</style>
