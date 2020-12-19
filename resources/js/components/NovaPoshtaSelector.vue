<template>
    <div id="nova-poshta-selector">
        <form @submit.prevent="submit" action="" method="POST">
            <slot></slot>
        <h3>Ваші контакти</h3>
        <div class="form-group">
            <label for="phone">Ваш телефон</label>
            <input
                type="tel"
                name="phone"
                id="phone"
                placeholder="+38063 111 11 11"
                class="form-control"
                v-model="phone"
            >
            <!-- /.form-control -->
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            <label for="firstName">Ваше ім'я.</label>
            <input
                type="text"
                name="firstName"
                id="firstName"
                placeholder="Ім'я"
                class="form-control"
                v-model="name"
            >
            <!-- /.form-control -->
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            <label for="familyName">Ваше прізвише.</label>
            <input
                type="text"
                name="familyName"
                id="familyName"
                placeholder="Прізвище"
                class="form-control"
                v-model="family"
            >
            <!-- /.form-control -->
        </div>
        <!-- /.form-group -->

        <div v-if="block1">
            <div class="form-group">
                <label for="search">Вкажіть назву населеного пункту</label>
                <input
                    type="text"
                    id="search"
                    name="search"
                    v-model="searchCity"
                    placeholder="Пошук міста..."
                    class="form-control"
                >
                <!-- /.form-control -->
            </div>
            <!-- /.form-group -->

            <div class="form-group" v-if="cites.length">
                <ul class="list-group">
                    <li
                        class="list-group-item"
                        v-for="city in cites"
                        :key="city.Ref"
                        @click="citySelect(city)"
                    >
                        {{city.SettlementTypeDescription+' '+
                    city.Description+', '+city.AreaDescription}}
                    </li>
                </ul>
            </div>
            <!-- /.form-group -->
            <div class="form-group" v-else>
                <p style="padding: 2.5rem" class="text-center">
                    Почніть вводити назву міста, щоб тут з'явилися варіанти.
                </p>
            </div>
        </div><!-- block1 -->
        <div v-else-if="block2">
            <h3>Обрати віділення Нова Пошта для {{selectCity.Description}}</h3>
            <div class="form-group" v-if="branches.length">
                <ul class="list-group">
                    <li
                        class="list-group-item"
                        v-for="branch in branches"
                        :key="branch.Ref"
                        @click="branchSelect(branch)"
                    >
                        {{branch.Description}}
                    </li>
                </ul>
            </div>
            <!-- /.form-group -->
            <div class="form-group" v-else>
                <p style="padding: 2.5rem" class="text-center">
                    В {{selectCity.Description}} - немає віділень.
                </p>
            </div>
        </div><!-- block2 -->
        <div v-else-if="block3">
            <div class="row my-3">
                <div class="col-md-6">
                    <ul class="list-group">
                        <li class="list-group-item">Сума: {{productsPrice}}</li>
                        <!-- /.list-group-item -->
                        <li class="list-group-item">Доставка: {{costName}}</li>
                        <!-- /.list-group-item -->
                    </ul>
                    <!-- /.list-group -->
                    <p><strong>Разом: {{price+cost.Cost}} грн.</strong></p>

                    <h4>Доставка в:</h4>
                    <p>{{selectCity.Description}}, <br />
                    {{selectBranch.Description}}</p>
                    <h5>Вартість доставки "НовПошта": {{costName}}</h5>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row my-3 -->
        </div>
        <dvi v-else>
            <div class="alert alert-warning" >
                <strong>
                    Помилка модуля замовлення
                </strong>
            </div>
            <!-- /.alert -->
        </dvi>
        <input type="hidden" name="np_city" :value="cityName">
        <input type="hidden" name="np_branch" :value="branchName">
        <input type="hidden" name="np_cost" :value="costName">

            <div class="form-group" v-if="block3">
                <button v-if="user.length" type="button" @click="newInfo" class="btn btn-info my-2">
                    Оновити реквізити доставки
                </button>
                <button type="button" @click="submit" class="btn btn-success byn-block py-2">
                    Перейти до оплати {{price+cost.Cost}} грн.
                </button>
                <!-- /.btn -->
            </div>
            <!-- /.form-group -->
        </form>
    </div>
    <!-- /#nova-poshta-selector -->
</template>

<script>
export default {
    props: ['phoneUser',
        'firstName',
        'familyName',
        'productPrice',
        'defaultCity',
        'defaultCityRef',
        'defaultBranch',
    ],
    data(){
        return {
            name: this.$props.firstName,
            family: this.$props.familyName,
            phone: this.$props.phoneUser,
            block1: true,
            block2: false,
            block3: false,
            searchCity: '',
            selectCity: {},
            selectBranch: {},
            cites: [],
            branches: [],
            price: 0,
            cost: 0,
            products: [],
            user: []
        }
    },
    computed:{
        productsPrice(){
            let price = 0
            this.products.forEach(i => {
                price += Number(i.price)
            })
            this.price = price
            return price + 'грн.'
        },

        cityName(){
            return this.selectCity.SettlementTypeDescription +', '
                +this.selectCity.Description+', '
                +this.selectCity.AreaDescription
        },
        branchName(){
            return this.selectBranch.Description
        },
        costName(){
            return this.cost.Cost + 'грн.'
        }
    },
    watch:{
        searchCity(){
            if (this.searchCity.length > 3){
                this.getCity()
            }else{
                this.cites = []
            }
        }
    },
    methods:{

        calcCost(){
            axios.post('/ajax/np/calc', {cityRef: this.selectCity.Ref})
            .then(r => {
                if (r.data.data.success){
                    this.block1 = false
                    this.block2 = false
                    this.block3 = true
                    this.cost = r.data.data.data[0]
                }
            })
        },

        getBranch(){
            axios.post('/ajax/np/city/branch', {
                cityRef: this.selectCity.Ref,
                cityName: this.selectCity.Description
            })
            .then(r => {

                if (r.data.data.success){
                    this.block1 = false
                    this.block2 = true
                    this.branches = r.data.data.data
                }
            })
        },

        branchSelect(br)
        {
            this.selectBranch = br
            this.calcCost()
        },

        citySelect(city){
            this.selectCity = city
            this.getBranch()
        },

        getCity(){
            axios.post('/ajax/np/city', {search: this.searchCity}).then(resp => {

                if (resp.data.data.success){
                    this.cites = resp.data.data.data
                }

            })
        },

        getProducts(){
            axios.post('/ajax/cart/get').then(r => {
                console.log(r.data.data)
                this.products = r.data.data.data
            })
        },
        checkData(){
            if(!this.phone.length){
                console.error('Phone incorrect')
                return false
            }
            if(!this.name.length){
                console.error('Name incorrect')
                return false
            }
            if(!this.family.length){
                console.error('Family incorrect')
                return false
            }

            return true
        },

        fetchUserData(){
            axios.post('/ajax/np/data').then(r => {
                this.user = r.data
                if (this.user.length){
                    this.block1 = false
                    this.block2 = false
                    this.block3 = true
                    this.selectCity.Description = this.user[0][0].city_string
                    this.selectCity.Ref = this.user[0][0].city_ref
                    this.selectBranch.Description = this.user[0][0].delivery_string
                    this.name = this.user[0][0].first_name
                    this.family = this.user[0][0].family_name
                    this.phone = this.user[0][0].phone
                    this.calcCost()
                }
            })

        },

        getData(){
            return {
                products: this.products,
                city: this.selectCity.SettlementTypeDescription +', '
                    +this.selectCity.Description+', '
                    +this.selectCity.AreaDescription,
                cityRef: this.selectCity.Ref,
                branch: this.selectBranch.Description,
                firstName: this.name,
                familyName: this.family,
                phone: this.phone,
                cost: this.cost.Cost,

            }
        },

        newInfo(){
            this.user = []
            this.block1 = true
            this.block2 = false
            this.block3 = false
        },

        submit(){
            console.log('Submit', this.getData())
            axios.post('/ajax/np/pay', this.getData()).then(r => {
                console.log(r.data)
            })
        }
    },
    mounted() {
        this.getProducts()
        this.fetchUserData()
        if (this.$props.defaultCity &&
            this.$props.defaultBranch &&
            this.phone &&
            this.name
        ){
            this.block1 = false
            this.block2 = false
            this.block3 = true
            this.selectCity.Description = this.$props.defaultCity
            this.selectCity.Ref = this.$props.defaultCityRef
            this.calcCost()
        }
    }

}
</script>

<style scoped lang="scss">
    ul{
        li{
            cursor: pointer;
            color: inherit;
            transition: all .5s;
            &:hover{
                font-size: 1.3rem;
                background: #383838;
                color: #4dc0b5;
            }
        }
    }
</style>
