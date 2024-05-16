import './bootstrap';
import { createApp } from 'vue';
import tablePage from './components/TablePage.vue';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap'

createApp({})
    .component('TablePage', tablePage)
    .mount('#app')
