@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header text-center">
            <h5>MINI BANK</h5>
            Admin Login
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="alert alert-warning alert-dismissible fade show">
                    <strong>Login Failed !</strong> You have 1/3 chances left.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="form-group">
                    <label for="login">Email address / Phone number</label>
                    <input
                        class="form-control @error('login') is-invalid @enderror"
                        id="login"
                        type="text"
                        name="login"
                        value="{{ old('login') }}"
                        required
                        autocomplete="login"
                        autofocus
                        placeholder="Enter email / phone number"
                    />
                    @error('login')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        class="form-control @error('password') is-invalid @enderror"
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Password"
                    />
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="{{ route('register') }}">Register an Account</a>
            </div>
        </div>
    </div>
</div>
@endsection
