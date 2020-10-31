<template>
    <div id="attributeBlock">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center">Атрибути товару</h3>
                    <!-- /.text-center -->
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
            <div class="row justify-content-center" v-if="alert.length">
                <div class="col-md-7">
                    <div class="alert alert-success text-center">
                        <strong>
                            {{alert}}
                        </strong>
                    </div>
                    <!-- /.alert -->
                </div>
                <!-- /.col-md-7 -->
            </div>
            <!-- /.row -->
            <div class="row" v-for="(item, index) in arrayAttributeField" :key="index">
                <div class="col-md-6">
                    <div class="form-group">
                        <input
                            v-model="item.name"
                            type="text"
                            class="form-control"
                            :placeholder="'Атрибут '+index"
                        >
                        <!-- /.form-control -->
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col-nd-6 -->
                <div class="col-md-6">
                    <div class="form-group">
                        <input
                            v-model="item.value"
                            type="text"
                            class="form-control"
                            :placeholder="'Значення '+index"
                        >
                        <!-- /.form-control -->
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col-nd-6 -->
            </div>
            <!-- /.row -->
            <div v-if="showFields" class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <button
                            @click="addNewField"
                            type="button"
                            class="btn btn-primary btn-block">
                            <i class="fas fa-plus-square"></i> Додати ще
                        </button>
                        <!-- /.btn -->
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <button @click="saveField" type="button"
                                class="btn btn-success btn-block"
                                :class="{'disabled': !showFields}"
                        >
                            <i class="fas fa-save"></i> Зберегти атрибути
                        </button>
                        <!-- /.btn -->
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
        <input type="hidden" name="attributes" :value="attributeJson">
    </div>
    <!-- /#attributeBlock -->
</template>

<script>
    export default {
        data(){
            return {
                arrayAttributeField: [
                    {name: '', value: ''}
                ],
                attributeJson: '',
                showFields: true,
                alert: ''
            }
        },
        methods:{
            addNewField(){
                this.arrayAttributeField.push({name: '', value: ''})
            },
            saveField(){
                if (this.showFields){
                    this.attributeJson = JSON.stringify(this.arrayAttributeField)
                    this.showFields = false
                    this.alert = 'Збережено !'
                }

            }
        }
    }
</script>

<style scoped>
    .container{
        margin: 1rem;
        padding: .5rem;
        border: 1px solid #111;
        border-radius: 10px;
    }
</style>
