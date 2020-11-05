<template>
    <div id="formOrder">
        <h3>Швидке замовлення</h3>
        <div
            class="alert"
            :class="{'alert-warning': error, 'alert-success': !error}"
            v-if="alert.length"
        >
            <strong>{{alert}}</strong>
        </div>
        <!-- /.alert -->
        <form @submit.prevent="submitForm" v-if="showForm">
            <div class="form-group">
                <label for=""></label>
                <input
                    type="tel"
                    v-model="phone"
                    class="form-control"
                    placeholder="Вкажіть свій телефон"
                >
                <!-- /.form-control -->
            </div>
            <!-- /.form-group -->

            <div class="form-group" >
                <button class="btn btn-primary btn-lg btn-block">Замовити</button>
                <!-- /.btn -->
            </div>
            <!-- /.form-group -->
        </form>
    </div>
    <!-- /#formOrder -->
</template>

<script>
    //QueryDataBuilder
    const QueryDataBuilder = (product_id, phone) => {
        return {
            product_id: Number(product_id),
            phone: phone
        }
    }

    //Config props
    const config = {
        alerts: {
            orderSuccess: 'Замовлення створено, очікуйте дзінка.',
            errorNumber: 'Некоректний ноиер телефону, мають бути лише цифри, довжина 10 або 12 символів.',
        },
        urlOrderExecute: '/ajax/order/new',

        maxPhoneLength: 12,
        minPhoneLength: 10,

        watchFilterPhone: /[^\d]/i,
        watchFilterReplace: ''

    }
    export default {
        props: ['productId'],
        data(){
            return {
                phone: '',
                showForm: true,
                validPhone: false,
                error: false,
                alert: ''
            }
        },
        methods:{
            submitForm(){
                this.error = false
                this.alert = ''
                if (this.testPhone()){
                    this.orderExecute()
                }else{
                    this.error = true
                    this.alert = config.alerts.errorNumber
                }

            },
            orderExecute(){
                axios.post(config.urlOrderExecute, QueryDataBuilder(this.$props.productId, this.phone))
                    .then(resp => {
                    if (resp.data.order){
                        this.showForm = false
                        this.alert = config.alerts.orderSuccess
                    }
                }).catch(err => {
                    this.error = true
                    this.alert = err.toString()
                    this.showForm = false
                })
            },
            testPhone(){
                const phone = this.phone
                if (phone.length === config.maxPhoneLength){
                    this.validPhone = true
                }else if (phone.length === config.minPhoneLength){
                    this.validPhone = true
                }else{
                    this.validPhone = false
                    return false
                }
                return true
            }
        },
        watch:{
            phone(){
                this.phone = this.phone.replace(config.watchFilterPhone, config.watchFilterReplace)
            }
        }
    }
</script>
