import './bootstrap';
import App from './src/App.vue';
import { createApp } from 'vue';
import VueTelInput from 'vue-tel-input';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-icons/font/bootstrap-icons.css';
import 'vue-tel-input/vue-tel-input.css';
import bootstrap from 'bootstrap/dist/js/bootstrap.js';

import ToastPlugin from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-bootstrap.css';

const app = createApp(App)
app.use(VueTelInput,{validCharactersOnly: true});
app.use(bootstrap);
app.use(ToastPlugin);
app.mount('#app');