window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

import Vue from 'vue'
import VuePersianDatetimePicker from 'vue-persian-datetime-picker'
import vSelect from 'vue-select';
import { Form, HasError, AlertError } from 'vform';

window.Form = Form;

Vue.component('discount-create', require('./components/discount/Create.vue').default);
Vue.component('discount-edit', require('./components/discount/Edit.vue').default);
Vue.component('fake-create', require('./components/fake/Create.vue').default);
Vue.component('fake-edit', require('./components/fake/Edit.vue').default);
Vue.component('amazing-product', require('./components/amazing/Edit.vue').default);
Vue.component('bundle-products', require('./components/bundle/Products').default);

Vue.component('date-picker', VuePersianDatetimePicker)
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component('v-select', vSelect);

const app = new Vue({
    el: '#app',
});
