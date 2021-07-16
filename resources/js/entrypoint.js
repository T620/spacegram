require('./bootstrap');

import { createApp } from 'vue';

import container from './components/Chat/container';


const app = createApp(container);

app.mount('#root');