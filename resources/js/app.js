require('./bootstrap');

window.Vue = require('vue').default;
import CKEditor from 'ckeditor4-vue';
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import VueAlertify from "vue-alertify"

Vue.use(CKEditor);
Vue.use(VueAlertify)
Vue.component('v-select', vSelect)

Vue.component('user-add', require('./components/User/Add.vue').default);
Vue.component('user-edit', require('./components/User/Edit.vue').default);

Vue.component('category-add', require('./components/Category/Add.vue').default);
Vue.component('category-edit', require('./components/Category/Edit.vue').default);

Vue.component('store-add', require('./components/Store/Add.vue').default);
Vue.component('store-edit', require('./components/Store/Edit.vue').default);

Vue.component('coupon-add', require('./components/Coupon/Add.vue').default);
Vue.component('coupon-edit', require('./components/Coupon/Edit.vue').default);
Vue.component('coupon-sorting', require('./components/Coupon/Sorting.vue').default);

Vue.component('deal-add', require('./components/Deal/Add.vue').default);
Vue.component('deal-edit', require('./components/Deal/Edit.vue').default);

Vue.component('blog-add', require('./components/Blog/Add.vue').default);
Vue.component('blog-edit', require('./components/Blog/Edit.vue').default);

Vue.component('add-page', require('./components/Page/Add.vue').default);
Vue.component('edit-page', require('./components/Page/Edit.vue').default);

Vue.component('website-setting', require('./components/Setting/Website.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



const app = new Vue({
    el: '#app',
});
