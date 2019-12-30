@extends('layouts.layout')

@section('content')

<body>
    <div class="container">
            @foreach($user as $user)
                <div class="card mb-4 mr-3" style="width: 18rem;">
                    <img class="card-img-top" src="{{ asset('storage/profile/' . $user->image) }}">
                    <div class="card-body">
                        <h4><strong>{{ $user->username }}</strong></h4>
                        @if(Auth::check())
                            <p class="card-text"><strong>First Name:</strong> {{ $user->first_name }}</br><strong>Last Name:</strong> {{ $user->last_name }}</p>
                            <a class="btn btn-primary" href="{{ route('user', $user->id)}}">Check profile page!</a>
                        @else
                            <p>Log in/register to see more account details.</p>
                        @endif
                    </div>
                </div> 
            @endforeach
        </div>
    </div>
</body>
@endsection
