import './styles/app.css';
import './bootstrap';

import { createApp } from 'vue'
import App from './vue/Main'

export const eventBus = createApp(App)

createApp(App).mount('#main')

// import Vue from 'vue'
import Main from "./vue/Main";
//
// import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
//
// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'
//
// Vue.use(BootstrapVue)
// Vue.use(IconsPlugin)
// import { DropdownPlugin, TablePlugin } from 'bootstrap-vue'
// Vue.use(DropdownPlugin)
// Vue.use(TablePlugin)
//
if (document.querySelector('#main')) {
    new Vue({
        render: (h) => h(Main),
    }).$mount('#main')
}