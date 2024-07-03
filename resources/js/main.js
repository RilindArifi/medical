import {createApp, markRaw} from 'vue';
import { createPinia } from 'pinia';
import { createI18n } from 'vue-i18n';
import router from '@/router';
import App from "@/App.vue";
import { BootstrapVue3, BToastPlugin } from 'bootstrap-vue-3';
import VCalendar from 'v-calendar';
import Antd from 'ant-design-vue';
import 'ant-design-vue/dist/reset.css';
import FlagIcon from 'vue-flag-icon';
import VueApexCharts from "vue3-apexcharts";
import vueCountryRegionSelect from 'vue3-country-region-select';
import VueSweetalert2 from 'vue-sweetalert2';
import acl from '@/acl';
import "@webzlodimir/vue-avatar/dist/style.css";
import { messages } from "@/lang/index.js";
import Cookies from "js-cookie";
import Breadcrumb from '@/components/breadcrumb/breadcrumb.vue';
import swal from 'sweetalert2';

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import '@fortawesome/fontawesome-free/css/fontawesome.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css';
import "vue3-circle-progress/dist/circle-progress.css";
import 'pe7-icon/dist/dist/pe-icon-7-stroke.css';
import 'typicons.font/src/font/typicons.css';
import 'weathericons/css/weather-icons.css';
import 'ionicons-npm/css/ionicons.css';
import "v-calendar/dist/style.css";
import '@/assets/css/feather.css';
import '@/assets/css/style.css';

window.Swal = swal;

const app = createApp(App);
const pinia = createPinia();

pinia.use(({ store }) => {
  store.router = markRaw(router);
});

const i18n = createI18n({
  locale: Cookies.get('locale') ?? 'en',
  fallbackLocale: 'en',
  messages,
});
app.component('Breadcrumb', Breadcrumb);
app.use(BootstrapVue3);
app.use(BToastPlugin);
app.use(VCalendar, {});
app.use(VueSweetalert2);
app.use(Antd);
app.use(VueApexCharts);
app.use(FlagIcon);
app.use(vueCountryRegionSelect);
app.use(i18n);
app.use(acl);
app.use(pinia);
app.use(router);
app.mount('#app');
