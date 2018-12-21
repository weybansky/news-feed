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

window.Event = new Vue();

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
  				this.categoryName = '';
  				this.categoryDescription = '';
  				Event.$emit('reloadCategories');
  			})
  			.catch((error) => {
  				alert(error.response.data.message);
  				this.errors.record(error.response.data.errors);
  				console.log(error.response.data.errors);
  			})
  	},

  },

})




Vue.component('category', {
	props: [ 'name', 'description', 'id', 'slug'],

	data(){
		return {
			classNameOne: 'card col-md-3 col-sm-4 col-xs-12 pr-0 pl-0 border-primary mb-3 animated',
			classNameTwo: 'fadeInRight',
		}
	},

	computed: {
		classNameAll() {
			return this.classNameOne + ' ' + this.classNameTwo;
		},

		feedUrl() {
			return "category/"+ this.slug + "/feed";
		},

		deleteUrl() {
			return "category/"+ this.id;
		},
	},

	methods: {
		deleteCategory(){
			axios.delete(this.deleteUrl)
				.then((response) => {
					this.classNameTwo = "fadeOutLeft";
					//console output
					console.log(response.data);
					// fire a delete event => remove the item from the array
					let category = {
						name: this.name,
						description: this.description,
						id: this.id
					}
					Event.$emit('deleteCategory', category);
				})
				.catch((error) => {
					console.log(error.response.data);
					alert(error.response.data.message);
				})
		},

	},

	template: `
	  <div :class="classNameAll">
	    <div class="card-header"> {{ name }} </div>
	    <div class="card-body text-secondary">
	      <p class="card-text"> {{ description }} </p>
	    </div>
	    <div class="card-footer text-right">
		    	<a :href="feedUrl" class="btn btn-sm btn-primary">View Feed</a>
		    	<button @click="editCategory" class="btn btn-sm btn-warning"><i class="fa fa-pen"></i></button>
		    	<button @click="deleteCategory" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
	    </div>
	  </div>
	`,

})

let categoryView = new Vue({
	el: '#category-view',

	data: {
		categories: {},
	},

	computed: {
		classNameAll() {
			return this.classNameOne + ' ' + this.classNameTwo;
		},
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

		deleteCategory (category) {
			console.log(category);
			this.getCategories();
		}

	},

	created(){
		Event.$on('deleteCategory', (category) => {
			alert(category.name + ' category deleted');
			this.deleteCategory(category);
		});
		Event.$on('reloadCategories', () => {
			this.getCategories();
		});
	}

})


// ==================================================================== //

// The Edit category component
Vue.component('category-edit', {
	props: ['name', ],

	data() {
		return {
			editUrl: '',
			categoryName: '',
			categoryDescription: '',
			errors: new Errors(),
		}
	},

	methods: {
		editCategory() {

		},

	},

	template: `
		<div id="categoryEdit" tabindex="-1" role="dialog" aria-labelledby="categoryEditTitle" aria-hidden="true" class="modal fade">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title text-center" style="width: 100%;" id="categoryEditTitle">Edit Category</h5>
		      </div>

		      <form :action="editUrl" method="POST" v-on:submit.prevent="editCategory" v-on:keydown="errors.clear($event.target.name)">
		      	<div class="modal-body">
		          <div class="form-group">
		            <label for="name" class="">Name</label>
		            <input type="text" name="name" class="form-control" placeholder="Category NameName" v-model="categoryName">
		            <span class="help-block text-danger" v-text="errors.get('name')"></span>
		          </div>
		          <div class="form-group">
		            <label for="description">Description</label>
		            <textarea name="description" class="form-control" placeholder="Category Description" v-model='categoryDescription'></textarea>
		            <span class="help-block text-danger" v-text="errors.get('description')"></span>
		          </div>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        	<button type="button" class="btn btn-color" v-bind:disabled='categoryName.length < 2' v-on:Click="editCategory">Add</button>
		      	</div>
		      </form>
		    </div>
		  </div>
		</div>
	`,
})

let categoryEdit = new Vue({
	el: '#categoryEditModal'
})