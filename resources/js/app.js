require('./bootstrap');

window.Vue = require('vue');

//Lazy Load
import VueLazyload from 'vue-lazyload'
Vue.use(VueLazyload, {
  preLoad: 1.3,
  attempt: 1
})

//Vuelidation
import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);

//Toast
import Toasted from 'vue-toasted'; 
Vue.use(Toasted);


//Components

//Layout
Vue.component('top-menu-component', require('./components/layouts/TopMenuComponent.vue'));
Vue.component('side-menu-component', require('./components/layouts/SideMenuComponent.vue'));

const app = new Vue({
    el: '#app',
    mounted(){
      autosize(document.querySelectorAll('textarea'));
    }
});
