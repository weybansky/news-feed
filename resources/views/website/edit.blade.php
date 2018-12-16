@extends('layouts.app')

@section('content')

    <section id="websites_add">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 card card-body">
            <form action="{{ url('website') }}/{{ $website->id }}" method="POST" id="addWebsites">
            @csrf @method('PATCH')
              <div class="form-group">
                <label for="name" class="">Name</label>
                <input type="text" name="name" class="form-control" placeholder="News Feed" value="{{ $website->name }}">
              </div>
              <div class="form-group">
                <label for="main_url">Main URL</label>
                <input type="url" name="main_url" class="form-control" placeholder="http://newsfeed.com" value="{{ $website->main_url }}">
              </div>
              <div class="form-group">
                <label for="feed_url">Feed Url</label>
                <input type="url" name="feed_url" class="form-control" placeholder="http://newsfeed.com/feed" value="{{ $website->feed_url }}">
              </div>
              <div class="form-group">
                <label for="feed_name">Feed Name</label>
                <input type="text" name="feed_name" class="form-control" placeholder="All Feed" value="{{ $website->feed_name }}">
              </div>
              <div class="form-group">
                <label for="category">Category</label>
                <select name="category" class="form-control">
                  <option value="{{ $website->category_id }}">{{ ucfirst($website->category->name) }}</option>
                  <option value="0">-- Select Category --</option>
                  @foreach($categories as $category)
                    @if($category->id != $website->category->id)
                    <option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="type_of_feed">Category</label>
                <select name="type_of_feed" class="form-control">
                  <option value="{{ $website->type_of_feed }}">{{ ucfirst($website->type_of_feed) }}</option>
                  <option value="other">-- Feed Type --</option>
                  <option value="rss">RSS</option>
                  <option value="atom">Atom</option>
                </select>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-color form-control">Update</button>
              </div>
            </form>
          </div>
      </div>
    </section>

@endsection