@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">Admin Registration</div>
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="exampleInputName">First name</label>
                            <input
                                class="form-control @error('first_name') is-invalid @enderror"
                                id="exampleInputName"
                                type="text"
                                name="first_name"
                                value="{{ old('first_name') }}"
                                required
                                autocomplete="first_name"
                                autofocus
                                placeholder="Enter first name"
                            />
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputLastName">Last name</label>
                            <input
                                class="form-control @error('last_name') is-invalid @enderror"
                                id="exampleInputLastName"
                                type="text"
                                name="last_name"
                                value="{{ old('last_name') }}"
                                required
                                autocomplete="name"
                                autofocus
                                placeholder="Enter last name"
                            />
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Email address</label>
                            <input
                                class="form-control @error('email') is-invalid @enderror"
                                id="exampleInputEmail1"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                placeholder="Enter email"
                            />
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputPhone">Phone number</label>
                            <input
                                class="form-control @error('phone_number') is-invalid @enderror"
                                id="exampleInputPhone"
                                type="tel"
                                name="phone_number"
                                value="{{ old('phone_number') }}"
                                required
                                autocomplete="phone_number"
                                placeholder="Enter phone number"
                            />
                            @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="exampleInputPassword1">Password</label>
                            <input
                                class="form-control @error('password') is-invalid @enderror"
                                id="exampleInputPassword1"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                placeholder="Password"
                            />
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="exampleConfirmPassword">Confirm password</label>
                            <input
                                class="form-control"
                                id="exampleConfirmPassword"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                placeholder="Confirm password"
                            />
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="{{ route('login') }}">Login Page</a>
            </div>
        </div>
    </div>
</div>
@endsection
