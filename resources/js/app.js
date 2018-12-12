
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});

function createWebsite(){
	let category   		= document.getElementsByName('name');
	// let name          = 
	// let main_url      = 
	// let feed_name     = 
	// let feed_url      = 
	// let type_of_feed  = 
	// let icon          = 

	let formData = new FormData();
	formData.append('name', 'Weybansky');


	axios.post('/axios')
	    .then(function (response) {
	        document.getElementById('data').innerHTML = JSON.stringify(response.data.websites);
	        console.log(response.data);
	    })
	    .catch(function (error) {
	        document.getElementById('data').innerHTML = error;
	        console.log(error);
	    })
}