@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="" method="POST">
                @csrf()
            </form>
        </div>
    </div>
</div>
@endsection
