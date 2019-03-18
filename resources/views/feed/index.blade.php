@extends('layouts.app')

@section('content')

	<section id="feed-view">
		<div class="container">
			<div class="row justify-content-center">
				<h3 style="color: white;">Feed</h3>
				<button type="button" class="btn btn-sm btn-link" v-on:click="getCategories"><i class="fa fa-redo"></i></button>
			</div>

			<div class="row">
				@foreach($feeds as $feed)
					<div class="col-12 col-sm-6 col-md-6">.
						<div class="card">
							<p class="card-header p-2">
								<img src="https://s2.googleusercontent.com/s2/favicons?domain_url={{$feed->website->main_url}}" style="width: 16px;height: 16px;" alt="" class="mr-2">
								<a class="text-secondary" href="{{$feed->website->main_url}}">{{ $feed->website->name }}</a>
								<span><i class="fa fa-dot mr-1 ml-1"></i></span>
									<small class="text-secondary">{{ \Carbon\Carbon::parse($feed->pub_date)->diffForHumans() }}</small>
							</p>
							<div class="card-body row pb-2 pt-2" style="min-height: 75px">
								<div class="col-4 col-sm-4 col-md-3 pr-1">
									<img class="img-fluid" src="images/admin.jpg" alt="">
								</div>
								<div class="col-8 col-sm-8 col-md-9 pl-1">
									<p class="card-title m-0"><a href="{{ $feed->post_url }}">{{ str_limit($feed->post_title, 50) }}</a></p>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>

			<div class="row justify-content-center">
				<div class="col-md-6">
					{{ $feeds->links() }}
				</div>
			</div>

			<div class="row" style="display: none;">
				{{-- feed icon
				feed title
				feed date
				feed site_icon
				feed site_name --}}
			</div>
		</div>
	</section>

@endsection