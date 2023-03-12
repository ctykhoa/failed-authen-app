@extends('layout')

@section('content')
    <div class="text-start border mt-5 rounded py-5 px-5 bg-light w-50 mx-auto">
        @if($isEditable)
            <h1 class="text-center">Edit Profile
                <a href="/profile" class="btn btn-success">View</a>
            </h1>

            @isset($errors)
                <div class="text text-danger">
                    @foreach($errors as $attr => $error)
                        <p>{{$attr}}: {{ json_encode($error) }}</p>
                    @endforeach
                </div>
            @endisset

            <form action="/editProfile" method="post">
                <p><b>Username: </b> <span>{{ $user->username }}</span>
                </p>
                <p><b>Email: </b>
                    <input class="form-control" name="email" type="text" value="{{ $user->email }}">
                </p>
                <p><b>Phone: </b>
                    <input class="form-control" name="phone" type="text" value="{{ $user->phone }}">
                </p>
                <p><b>Shipping Address: </b>
                    <input class="form-control" name="shipping_address" type="text"
                           value="{{ $user->shipping_address }}">
                </p>
                <p><b>Created At: </b> <span>{{ $user->created_at }}</span></p>
                <button class="btn btn-success" type="submit">Submit</button>
            </form>
        @else
            <h1 class="text-center">View Profile
                <a href="/editProfile" class="btn btn-success">Edit</a>
            </h1>

            <p><b>Username: </b> <span>{{ $user->username }}</span></p>
            <p><b>Email: </b> <span>{{ $user->username }}</span></p>
            <p><b>Phone: </b> <span>{{ $user->phone }}</span></p>
            <p><b>Shipping Address: </b> <span>{{ $user->shipping_address }}</span></p>
            <p><b>Created At: </b> <span>{{ $user->created_at }}</span></p>
        @endif

    </div>
@endsection
