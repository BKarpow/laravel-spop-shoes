<template>
    <div id="uploadBlock">
        <div class="image_block m-2">
            <img
                v-if="uploaded"
                :src="path"
                alt=""
                class="img-fluid"
                style="width: 300px;"
            >

            <div class="fl_upld" v-if="!uploaded">
                <label>
                    <input
                        id="fl_inp"
                        type="file"
                        ref="image"
                        @change="changeFile"
                    >
                    <slot></slot>
                </label>
                <div id="fl_nm">Фото не обрано</div>
            </div>

            <div class="progress" v-if="showProgress && !errorMessage.length">
                <div
                    class="progress-bar"
                    role="progressbar"
                    :style="{width:  uploadPercentage+'%'}"
                    :aria-valuenow="uploadPercentage"
                    aria-valuemin="0"
                    aria-valuemax="100">
                    {{ uploadPercentage + '%' }}
                </div>
            </div>
            <div v-if="errorMessage.length" class="alert alert-warning">
                <strong>{{errorMessage}}</strong>
            </div>
            <!-- /.alert -->
            <input v-if="uploaded" type="hidden" :name="nameInput" :value="path">
        </div>
        <!-- /.image_block -->

    </div>
    <!-- /#uploadBlock -->
</template>

<script>
    export default {
        props: ['uploadUrl', 'nameInput'],
        data(){
            return {
                uploaded: false,
                path: '',
                uploadPercentage: 0,
                showProgress: false,
                errorMessage: ''
            }
        },
        methods:{
            uploadedImage(){
                const file = this.$refs.image.files[0]
                const form = new FormData()
                form.append('image', file);
                this.showProgress = true
                axios.post(this.$props.uploadUrl,
                    form,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        },
                        onUploadProgress: function(progressEvent) {
                            this.uploadPercentage = parseInt(Math.round(( progressEvent.loaded / progressEvent.total) * 100))
                        }.bind(this)
                    }
                ).then(resp => {
                    const d = resp.data
                    this.showProgress = false
                    if (d.ok){
                        this.uploaded = true
                        this.path = resp.data.path
                        this.$emit('load-success', this.path)
                    }else{
                        this.errorMessage = 'Помилка завантаження'
                    }

                }).catch(err => {
                    this.errorMessage = err.toString()
                })
            },
            changeFile(){
                console.log('File selected')
                this.uploadedImage()
            }
        }
    }
</script>

<style>
    .fl_upld{width:300px;}
    #fl_inp{display:none;}
    .fl_upld label{
        cursor:pointer;
        background:#36c;
        border-radius:3px;
        padding:10px 25px;
        color:#fff;
        font-weight:bold;
        text-align: center;
    }
    .fl_upld label:hover{background:#fc0;}
    #fl_nm{
        margin-top:20px;
        color:#f00;}
</style>
