import './bootstrap';
import '../css/app.css';

import { createApp } from 'vue/dist/vue.esm-bundler';
import contactComponent from "./components/Contact.vue";

const app = createApp({});
app.component('contact', contactComponent)
app.mount('#app');


