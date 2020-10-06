import _ from "lodash";

window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Vue from 'vue'
import vuetify from '@/plugins/vuetify' // path to vuetify export
import router from '@/router';
import {store} from "@/store";

Object.defineProperty(Vue.prototype, '$_', {value: _});
window.bus = new Vue();

import VCurrencyField from 'v-currency-field'

Vue.use(VCurrencyField, {
  locale: 'en',
  decimalLength: 2,
  autoDecimalMode: true,
  min: null,
  max: null,
  defaultValue: 0,
  valueAsInteger: false,
  allowNegative: true
});

import App from '@/App';

new Vue({
  vuetify,
  router,
  store,
  render: h => h(App),
}).$mount('#app')
