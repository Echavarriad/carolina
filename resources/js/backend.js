
window._ = require('lodash');
window.axios = require("axios");
// window.$ = window.jQuery = require('jquery');

let base_url = document.head.querySelector('meta[name="base-url"]');
let color_primary = document.head.querySelector('meta[name="theme-color"]').content;

if (window.axios) {
    window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';    

    let token = document.head.querySelector('meta[name="csrf-token"]');

    if (token) {
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    } else {
        console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
    }

    if (base_url) {
        window.axios.defaults.baseURL = base_url.content;
        window.base_url = base_url.content;
    }
}

window.Vue = require('vue').default;
import VueToast from 'vue-toast-notification';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import 'vue-toast-notification/dist/theme-sugar.css';
import Vue from 'vue';
const options = {
    allowOutsideClick: false,
    confirmButtonColor:color_primary,  
    cancelButtonColor :'#757575',
};
Vue.use(VueSweetalert2 , options);
Vue.use(VueToast,{
    position : 'bottom-right',
    duration : 4000
});

Vue.component('product-relateds', require('./components/backend/ProductRelated.vue').default);
Vue.component('product-gallery', require('./components/backend/ProductGallery.vue').default)
Vue.component('upload-images', require('./components/backend/UploadImages.vue').default)
Vue.component('c-switch', require('./components/backend/Switch.vue').default);
Vue.component('delete-file', require('./components/backend/DeleteFile.vue').default);
Vue.component('attribute-options', require('./components/backend/AttributeOptions.vue').default);
Vue.component('price-variations', require('./components/backend/PriceVariations.vue').default);
Vue.component('manager-product-siigo', require('./components/backend/ManagerProductSiigo.vue').default);;
// Vue.component('rules-discount', require('./components/backend/RulesDiscount.vue').default);
// Vue.component('user-coupon', require('./components/backend/UserCoupon.vue').default);


$(document).ready(function () {
    const app = new Vue({
        el: '#app'
    });
});