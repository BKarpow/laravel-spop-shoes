/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.$ = require('jquery')

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('create-price', require('./components/CreatePrice.vue').default)
Vue.component('create-image-box', require('./components/CreateImageBox.vue').default)
Vue.component('upload-block', require('./components/UploadBlock.vue').default)
Vue.component('selector-category', require('./components/SelectorCategory.vue').default)
Vue.component('attribute-component', require('./components/AttributeComponent.vue').default)
Vue.component('add-attribute-from-product', require('./components/AddAttributeFromProduct.vue').default)
Vue.component('info-block', require('./components/InfoBlock.vue').default)
Vue.component('Orders', require('./components/IB/OrdersNew.vue').default)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
