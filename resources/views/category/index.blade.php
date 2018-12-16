@extends('layouts.app')

@section('content')

	<section id="category">
	  <div class="container">
	    <div class="row">
	      <div class="col-md-12 col-sm-12 text-right">
	        <!-- Button trigger modal -->
	        <button type="button" class="btn btn-color animated slideInLeft" data-toggle="modal" data-target="#exampleModalCenter">
	          <i class="fa fa-plus"></i> Category
	        </button>
	      </div>

	      <!-- Modal -->
	      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	        <div class="modal-dialog modal-dialog-centered" role="document">
	          <div class="modal-content">
	            <div class="modal-header">
	              <h5 class="modal-title text-center" style="width: 100%;" id="exampleModalCenterTitle">Add New Category</h5>
	            </div>

	            <form action="{{ url('category') }}" method="POST" id="addCategory" v-on:submit.prevent="addNewCategory" v-on:keydown="errors.clear($event.target.name)">
	            	@csrf
	            	<div class="modal-body">
	                <div class="form-group">
	                  <label for="name" class="">Name</label>
	                  <input type="text" name="name" class="form-control" placeholder="News Feed" v-model="categoryName" autocomplete="on">
	                  <span class="help-block text-danger" v-text="errors.get('name')"></span>
	                </div>
	                <div class="form-group">
	                  <label for="description">Description</label>
	                  <textarea name="description" class="form-control" placeholder="Description" v-model='categoryDescription'></textarea>
	                  <span class="help-block text-danger" v-text="errors.get('description')"></span>
	                </div>
	            	</div>
	            	<div class="modal-footer">
	              	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	              	<button type="button" class="btn btn-color" v-bind:disabled='categoryName.length < 0' v-on:Click="addNewCategory">Add</button>
	            	</div>
	            </form>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</section>

	<section id="category-view">
		<div class="container">
			<div class="row justify-content-center">
				<h3 style="color: white;">
					Categories
				</h3>
				<button type="button" class="btn btn-sm btn-link"><i class="fa fa-redo"></i></button>
			</div>
			<div class="row">
				<category v-for="category in categories" v-bind:key="category.id" v-bind:id="category.id" v-bind:name="category.name" v-bind:description="category.description"></category>
			</div>
		</div>
	</section>

@endsection