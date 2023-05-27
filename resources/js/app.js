import './bootstrap';
import { createApp } from 'vue'
import router from './router'
import App from './App.vue'
import BalmUI from 'balm-ui/dist/balm-ui'; // Official Google Material Components
import BalmUIPlus from 'balm-ui/dist/balm-ui-plus'; // BalmJS Team Material Components

import '../scss/app.scss'


const app = createApp(App);

app.use(router);
app.use(BalmUI); // Mandatory
app.use(BalmUIPlus); // Optional

app.mount("#app");
