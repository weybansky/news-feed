@extends('layouts.app')

@section('content')
  
    <section id="action_menu">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-right">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-color animated slideInLeft" data-toggle="modal" data-target="#exampleModalCenter">
              <i class="fa fa-plus"></i> Website Feed
            </button>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title text-center" style="width: 100%;" id="exampleModalCenterTitle">Add New Feed</h5>
                </div>

                <form action="{{ url('website') }}" method="POST" id="addWebsites">
                	@csrf
                	<div class="modal-body">
                    <div class="form-group">
                      <label for="name" class="">Name</label>
                      <input type="text" name="name" class="form-control" placeholder="News Feed" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                      <label for="main_url">Main URL</label>
                      <input type="url" name="main_url" class="form-control" placeholder="http://newsfeed.com" value="{{ old('main_url') }}">
                    </div>
                    <div class="form-group">
                      <label for="feed_url">Feed Url</label>
                      <input type="url" name="feed_url" class="form-control" placeholder="http://newsfeed.com/feed" value="{{ old('feed_url') }}">
                    </div>
                    <div class="form-group">
                      <label for="feed_name">Feed Name</label>
                      <input type="text" name="feed_name" class="form-control" placeholder="All Feed" value="{{ old('feed_name') }}">
                    </div>
                    <div class="form-group">
                      <label for="category">Category</label>
                      <select name="category" class="form-control">
                        <option value="0">-- Select Category --</option>
                        @foreach($categories as $category)
                          <option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="type_of_feed">Category</label>
                      <select name="type_of_feed" class="form-control">
                        <option value="other">-- Feed Type --</option>
                        <option value="rss">RSS</option>
                        <option value="atom">Atom</option>
                      </select>
                    </div>
                	</div>
                	<div class="modal-footer">
                  	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  	<button type="submit" class="btn btn-color">Add</button>
                	</div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="websites_add">
      <div class="container">
        <div class="row">
        	@foreach($websites as $website)
	          <div class="col-sm-6 col-md-4">
	            <div class="card animated fadeInUp">
	              <img class="card-img-top" src="{{ asset('images/admin.jpg') }}" alt="Card image cap">
	              <div class="card-body">
	                <h5 class="card-title">{{ $website->name }}</h5>
	                <p class="card-text">{{ $website->main_url }}</p>
	                <p class="card-text">{{ $website->feed_name }} ({{ $website->type_of_feed }}) : <a href="{{ url('feed/run') }}/{{ $website->id }}" class="btn btn-sm btn-color"><i class="fa fa-globe"></i> RUN</a></p>
	                <p class="card-text"><a href="{{ $website->feed_url }}">{{ $website->feed_url }}</a></p>
                  <a href="{{ url('website') }}/{{ $website->id }}/feed" class="btn btn-sm btn-color"><i class="fa fa-globe"></i> Feed</a>
	                <a href="{{ $website->main_url }}" class="btn btn-sm btn-link"><i class="fa fa-globe"></i> Visit</a>
	                <a href="{{ url('website') }}/{{ $website->id }}/edit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                  <form action="{{ url('website') }}/{{ $website->id }}" method="POST" style="display: inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
                  </form>
	              </div>
	            </div>                
	          </div>
        	@endforeach
      </div>
    </section>

@endsection