    @extends('layouts.layout')

@section('content')

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-md-offset-1">
                <div class="card">
                    <h5 class="card-header">Your account details</h5>
                    <div class="card-body">
                        <h5 class="card-title">Change your account details or keep them the same, the choice is yours!</h5>
                    </br>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form enctype="multipart/form-data" method="post" action="{{ url('profile/'.$user->id.'/update') }}">
                     	    @method('PATCH')
                            @csrf
                            <div class="form-group">

                               	<img class="foto" src="{{ asset('storage/profile/' . $user->image) }}">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                <input type="file" name="image" accept="image/*">
                            </div>

                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" name="username" value={{ $user->username }} />
                            </div>
                            <div class="form-group">
                                <label for="first_name">First name:</label>
                                <input type="text" class="form-control" name="first_name" value={{ $user->first_name }} />
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last name:</label>
                                <input type="text" class="form-control" name="last_name" value={{ $user->last_name }} />
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" name="email" value={{ $user->email }} />
                            </div>
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" name="address" value={{ $user->address }} />
                            </div>
                            <div class="form-group">
                                <label for="zipcode">Zipcode:</label>
                                <input type="text" class="form-control" name="zipcode" value={{ $user->zipcode }} />
                            </div>
                            <div class="form-group">
                                <label for="relationship_status">Relationship Status:</label>
                                <select type="text" class="form-control" name="relationship_status">
                                    <option value="1" @if($user->relationship_status == 1) selected @endif>Single ready to mingle!</option>
                                    <option value="2" @if($user->relationship_status == 2) selected @endif>Married to someone I hate</option>
                                    <option value="3" @if($user->relationship_status == 3) selected @endif>You guys have relationships?</option>
                                    <option value="4" @if($user->relationship_status == 4) selected @endif>What is a relationship?!</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection
