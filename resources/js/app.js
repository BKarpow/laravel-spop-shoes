/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// require('./zoomsl');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


// import Swiper JS
import Swiper from 'swiper';
// import Swiper styles
import 'swiper/swiper-bundle.css';




Vue.component('search-component', require('./components/SearchInput.vue').default);
Vue.component('product-card', require('./components/ProductCard.vue').default);
Vue.component('products-box', require('./components/ProductsBox.vue').default);
Vue.component('popular-products-box', require('./components/PopularProductsBox.vue').default);
Vue.component('order-form', require('./components/OrderForm.vue').default);
Vue.component('nav-bar-category', require('./components/NavBarCategory.vue').default);
Vue.component('like-box', require('./components/LikeBox.vue').default);
Vue.component('cart', require('./components/CartModal.vue').default);
Vue.component('add-to-cart', require('./components/AddToCartButton.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data:{
        triggerCart: 0
    },
    methods:{
        incrementTriggerCart(){
            this.$refs.cart.fetchCart()
        },
        removeFromCart(pid){
            this.$refs.add.rmFromCart(pid)
        }
    }
});
