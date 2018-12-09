@extends('layouts.app')

@section('content')
  
    <section id="action_menu">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-right">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-color" data-toggle="modal" data-target="#exampleModalCenter">
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

                <form action="{{ url('websites') }}" method="POST">
                	@csrf
                	<div class="modal-body">
                    <div class="form-group">
                      <label for="name" class="">Name</label>
                      <input type="text" name="name" class="form-control" placeholder="News Feed">
                    </div>
                    <div class="form-group">
                      <label for="main_url">Main URL</label>
                      <input type="url" name="main_url" class="form-control" placeholder="http://newsfeed.com">
                    </div>
                    <div class="form-group">
                      <label for="feed_url">Feed Url</label>
                      <input type="url" name="feed_url" class="form-control" placeholder="http://newsfeed.com/feed">
                    </div>
                    <div class="form-group">
                      <label for="feed_name">Feed Name</label>
                      <input type="text" name="feed_name" class="form-control" placeholder="All Feed">
                    </div>
                    <div class="form-group">
                      <label for="category">Category</label>
                      <select name="category" class="form-control">
                        <option value="0">-- Select Category --</option>
                        <option value="uncategorized">Uncategorized</option>
                        <option value="news">News</option>
                        <option value="technology">Technology</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="type_of_feed">Category</label>
                      <select name="type_of_feed" class="form-control">
                        <option value="0">-- Feed Type --</option>
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
	          <div class="col-sm-4">
	            <div class="card">
	              <img class="card-img-top" src="{{ asset('images/admin.jpg') }}" alt="Card image cap">
	              <div class="card-body">
	                <h5 class="card-title">{{ $website->name }}</h5>
	                <p class="card-text">{{ $website->main_url }}</p>
	                <p class="card-text">{{ $website->feed_name }}:</p>
	                <p class="card-text">{{ $website->feed_url }}</p>
	                <a href="{{ $website->main_url }}" class="btn btn-sm btn-link"><i class="fa fa-globe"></i> Visit</a>
	                <button type="button" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</button>
	                <button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
	              </div>
	            </div>                
	          </div>
        	@endforeach
        </div>
      </div>
    </section>

@endsection