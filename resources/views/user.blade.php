@extends('layouts.layout')

@section('content')

<?php 
    $i = 0;
    foreach($likes as $like){
        var_dump($i++);
    } 
?>

<body>
	<div class="container border rounded bg-white">
		@if (session('status'))
	        <div class="alert alert-success" id="disappear" role="alert">
	            {{ session('status') }}
	        </div>
	    @endif
	    @if (session('fail'))
	        <div class="alert alert-danger" id="disappear" role="alert">
	            {{ session('fail') }}
	        </div>
	    @endif
		</br>
	    <div class="row">
	        <div class="col-sm-offset-1 col-sm-4">
	        	<img src="{{ asset('storage/profile/' . $user->image) }}">
	        </div>

	        <div class="col-sm-7">

	        	<h2>{{ $user->username }}</h2>
	        	</br>
	        	<p><strong>First Name:</strong> {{ $user->first_name }}</p>
				<p><strong>Last Name:</strong> {{ $user->last_name }}</p>
				<p><strong>Address:</strong> {{ $user->address }}</p>
				<p><strong>Zipcode:</strong> {{ $user->zipcode }}</p>
				<p><strong>Relationship status:</strong> 
					@if($user->relationship_status == 1) Single ready to mingle! @endif
                    @if($user->relationship_status == 2) Married to someone I hate @endif
                    @if($user->relationship_status == 3) You guys have relationships? @endif
                    @if($user->relationship_status == 4) What is a relationship? @endif
                </p>
                <p>
                </p>
				<a class="btn btn-primary" href="{{ route('like', ['id' => Auth::id()]) }}">Like me</a>
	        </div>
    	</div>
    	</br>
	</div>
</body>

{{-- <script>
	var token = '{{ Session::token() }}';
	var urlEdit = '{{ route('user') }}';
	var urlLike = '{{ route('like') }}';
</script> --}}
@endsection