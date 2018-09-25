
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import {VueMasonryPlugin} from 'vue-masonry';
import VueProgressBar from 'vue-progressbar'

const options = {
  color: '#26C281',
  tempColor: '#E43A45',
  failedColor: '#874b4b',
  thickness: '2px',
  transition: {
    speed: '1s',
    opacity: '.6s',
    termination: 300
  },
  autoRevert: true,
  location: 'top',
  inverse: false,
  position: 'absolute'
}
Vue.use(VueProgressBar, options)
Vue.use(VueMasonryPlugin)

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

// Vue.component('example', require('./components/Example.vue'));

Vue.component('price-board', require('./components/PriceBoard.vue'));
Vue.component('price-group', require('./components/PriceBoardGroup.vue'));

 
Vue.component('monitor', require('./components/monitor/Monitor.vue'));
Vue.component('monitor-item', require('./components/monitor/Item.vue'));



if(document.getElementById("app")){
const app = new Vue({
    el: '#app'
});
}

