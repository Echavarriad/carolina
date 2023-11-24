require('./bootstrap');

window.Vue = require('vue').default;

let color_primary = document.head.querySelector('meta[name="theme-color"]').content;

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)

import Vuex from 'vuex'
Vue.use(Vuex)

import VueSweetalert2 from 'vue-sweetalert2';
import VueToast from 'vue-toast-notification';
import 'sweetalert2/dist/sweetalert2.min.css';
import 'vue-toast-notification/dist/theme-sugar.css';
const options = {
  allowOutsideClick: false,
  confirmButtonColor:color_primary,
  cancelButtonColor: '#3b3b39'
};
Vue.use(VueSweetalert2 , options);
Vue.use(VueToast,{
    position : 'bottom-right',
    duration : 4000
});

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.component('login', require('./components/frontend/account/Login.vue').default);

Vue.component('register', require('./components/frontend/account/Register.vue').default);
Vue.component('list-address', require('./components/frontend/account/ListAddress.vue').default);
Vue.component('my-account', require('./components/frontend/account/MyAccount.vue').default);
Vue.component('change-password', require('./components/frontend/account/ChangePassword.vue').default);
Vue.component('forgot-password', require('./components/frontend/account/ForgotPassword.vue').default);
Vue.component('variations', require('./components/frontend/products/Variations.vue').default); 
Vue.component('add-to-cart', require('./components/frontend/products/AddToCart.vue').default); 
Vue.component('manager-favorite', require('./components/frontend/products/ManagerFavorite.vue').default);
Vue.component('count-cart', require('./components/frontend/products/CountCart.vue').default);
Vue.component('gallery', require('./components/frontend/products/Gallery.vue').default);
Vue.component('count-favorite', require('./components/frontend/products/CountFavorite.vue').default);
Vue.component('cart', require('./components/frontend/checkout/Cart.vue').default);
Vue.component('checkout', require('./components/frontend/checkout/Checkout.vue').default);
Vue.component('payment', require('./components/frontend/checkout/Payment.vue').default);
Vue.component('coupon', require('./components/frontend/checkout/Coupon.vue').default);
Vue.component('search-products', require('./components/frontend/products/SearchProducts.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const store = new Vuex.Store({
	state : {
		user : {},
		order : {}
	}, 
	getters:{
		getUser : state => {
			return state.user
		},    
	}
});
  const app = new Vue({
      el: '#vue',
      store,
      methods : {
        incrementcart : function(value){
          this.$refs.count_cart.count += value;        
        },
      	updatecart : function(value){
          this.$refs.count_cart.count = value;
      	},
        incrementfavorite : function(value){
          this.$refs.count_favorite.count += value;        
        },
        changeStatusGif(bool){
          var $j = jQuery.noConflict();
          if (bool) {
            this.$nextTick(function () {
              $j('.loader_shop').fadeIn();
            });
          }else{
            this.$nextTick(function () {
              $j('.loader_shop').fadeOut();
            });
          }
        }
        
        
      }
      
  });
