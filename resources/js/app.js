require('./bootstrap');

import store from './store/vuex'
import VuejsPaginate from 'vuejs-paginate'
import Swal from 'sweetalert2'
import VModal from 'vue-js-modal/dist/index.nocss.js'
import 'vue-js-modal/dist/styles.css'
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import 'vue-search-select/dist/VueSearchSelect.css'
import { global } from './mixins';

window.Vue = require('vue');
window.Swal = Swal;

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('lot-list', require('./components/Lot.vue').default);
Vue.component('agent-list', require('./components/Agent.vue').default);
Vue.component('applicant-list', require('./components/Applicant.vue').default);
Vue.component('transaction-list', require('./components/Transaction.vue').default);
Vue.component('fill-up-form', require('./components/Form.vue').default);
Vue.component('user-list', require('./components/User.vue').default);
Vue.component('paginate', VuejsPaginate);
Vue.component('loading', Loading);

Vue.use(VModal, { dynamicDefault: { draggable: true } })

Vue.mixin(global)

store.commit('setConfig', window.config)

const app = new Vue({
    el: '#app',
    store,
});
