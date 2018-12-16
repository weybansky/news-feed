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

// Classes
class Errors {
	constructor () {
		this.errors = {};
	}

	get (field){
		if (this.errors[field]) {
			return this.errors[field][0];
		}
	}

	clear (field) {
		delete this.errors[field];
	}

	record (errors) {
		this.errors = errors;
	}

}

let category = new Vue({
  el: '#addCategory',

  data: {
    categoryName: '',
    categoryDescription: '',
    errors: new Errors(),

  },

  methods: {
  	addNewCategory() {
  		axios.post('category', {
  				name: this.categoryName,
  				description: this.categoryDescription
  			})
  			.then((response) => {
  				console.log(response.data);
  			})
  			.catch((error) => {
  				this.errors.record(error.response.data.errors);
  				console.log(error.response.data.errors);
  			})
  	},

  },

})




Vue.component('category', {
	props: [ 'name', 'description', 'id'],

	computed: {
		feedUrl() {
			return "category/"+ this.id + "/feed";
		},

		deleteUrl() {
			return "category/"+ this.id;
		}
	},

	methods: {
		deleteCategory(){
			alert(this.id);
			axios.delete(this.deleteUrl)
				.then((response) => {
					//console output
					console.log(response.data);
					// fire a delete event => remove the item from the array
					// $emit('delete');
				})
				.catch((error) => {
					console.log(error.response.data);
					alert(error.response.data.message);
				})
		},

	},

	template: `
	  <div class="card col-md-4 col-sm-6 col-xs-12 pr-0 pl-0 border-primary mb-3 animated fadeInRight">
	    <div class="card-header"> {{ name }} </div>
	    <div class="card-body text-secondary">
	      <p class="card-text"> {{ description }} </p>
	    </div>
	    <div class="card-footer text-right">
		    	<button @click="deleteCategory" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
		    	<a :href="feedUrl" class="btn btn-sm btn-primary">View Feed</a>
		    	<a :href="deleteUrl" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
	    </div>
	  </div>
	`,

})

let categoryView = new Vue({
	el: '#category-view',

	data: {
		categories: {},
	},

	mounted () {
		this.getCategories();
	},

	methods: {
		getCategories () {
			axios.get('category/all')
				.then((response) => {
					console.log(response.data);
					this.categories = response.data.categories;
				})
				.catch((error) => {
					console.log(error.response.data);
				})

		},

	}

})
