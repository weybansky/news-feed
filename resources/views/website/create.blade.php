@extends('layouts.app')

@section('content')

    <section id="websites_add">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6 card card-body">
            <form action="{{ url('website') }}" method="POST" id="addWebsite">
            @csrf
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
              <div class="form-group">
                <button type="submit" class="btn btn-color form-control">Update</button>
              </div>
            </form>
          </div>
      </div>
    </section>

@endsection