
require('./bootstrap');

window.Vue = require('vue').default;
require('./components/SelectDistrict');
require('./components/UserAddressesCreateAndEdit');

const app = new Vue({
    el: '#app',
});
