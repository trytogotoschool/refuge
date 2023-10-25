import { registerVueControllerComponents } from '@symfony/ux-vue';
import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';
import VueRouter from 'vue-router'
import { createApp } from 'vue';
import App from './vue/App.vue'
import ContainerIndex from './vue/components/ContainerIndex'
const routes = [
    {path: '/', component: ContainerIndex}
]
createApp(App).mount("#app");

 