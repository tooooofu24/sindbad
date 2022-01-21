require('./bootstrap');

import { createApp } from 'vue'
import ExampleComponent from './components/ExampleComponent.vue'
import axios from 'axios';

createApp({
    components: {
        ExampleComponent
    }
}).mount('#app')