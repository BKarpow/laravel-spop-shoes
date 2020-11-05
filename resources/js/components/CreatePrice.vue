<template>
    <div id="create_price">
        <div class="form-group" v-if="showBlockInput">
            <input
                type="text"
                class="form-control"
                placeholder="Ціна"
                v-model="uan"
            >
            <!-- /.form-control -->
            <input
                type="text"
                class="form-control mt-3"
                placeholder="Ціна зі знижкою"
                v-model="uan_min"
            >
            <!-- /.form-control -->
        </div>
<!--        <div class="form-group" v-if="showBlockInput">-->
<!--            <button @click="testPrice" type="button" class="btn btn-danger">Створити ціну</button>-->
<!--        </div>-->
<!--        &lt;!&ndash; /.form-group &ndash;&gt;-->
<!--        <div-->
<!--            class="alert"-->
<!--            :class="{'alert-warning': error, 'alert-success': priceCreate}"-->
<!--            v-if="showBlockAlert"-->
<!--        >-->
<!--            <strong>-->
<!--                {{ alert }}-->
<!--            </strong>-->
<!--        </div>-->
<!--        &lt;!&ndash; /.alert &ndash;&gt;-->
<!--        <input type="hidden" v-if="priceCreate" name="price_id" :value="priceId" >-->
        <input type="hidden" name="uan" :value="uan">
        <input type="hidden" name="uan_min" :value="uan_min">
    </div>
    <!-- /#create_price -->
</template>

<script>
    export default {
        props: ['createPriceUrl'],
        data(){
            return {
                uan: '',
                uan_min: '',
                showBlockAlert: false,
                showBlockInput: true,
                error: false,
                alert: '',
                priceCreate: false,
                priceId: ''
            }
        },
        methods:{
            createPrice(){
                axios.post(this.$props.createPriceUrl, {uan: this.uan, uan_min: this.uan_min})
                .then(response => {
                    console.log('Response ', response)
                    this.showBlockInput = false
                    this.priceCreate = true
                    this.showBlockAlert = true
                    this.error = false
                    this.alert = 'Ціну створено'
                    this.priceId = response.data.result.id
                })
                .catch(error => {
                    console.error(error)
                })
            },
            testPrice(){
                const uan = Number(this.uan)
                const uan_min = Number(this.uan_min)
                if(!uan || !uan_min){
                    this.showBlockAlert = true
                    this.alert = 'Ціна вказана некоректно'
                    this.error = true
                    return
                }
                if (uan_min > uan){
                    this.showBlockAlert = true
                    this.alert = 'Ціна зі знижкою більша ніж звичайна'
                    this.error = true
                }else{
                    this.showBlockAlert = false
                    this.alert = ''
                    this.error = false
                    this.createPrice()
                }
            },
        },
        watch:{
            uan(){
                this.uan_min = this.uan
            }
        },
    }
</script>
