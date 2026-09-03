import './bootstrap';
import 'bootstrap'

import { createApp } from 'vue';
import Invoice from './components/Invoice.vue';

const app = createApp({});

app.component('invoice', Invoice);

app.mount('#app');