@extends('layouts.auth')

@section('content')
    <div class="mycontainer">
        <div class="mycard-wrapper">
            <div class="mycontent">
                <h3 class="text-white mb-2">Register Form</h3>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Name</span>
                            <input id="name" name="name" type="text" class="form-control">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Email</span>
                            <input id="email" name="email" type="email" class="form-control">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Password</span>
                            <input id="password" name="password" type="password" class="form-control">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Confirm Password</span>
                            <input id="password-confirm" name="password_confirmation" type="password" class="form-control">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-end">
                            <button class="btn btn-primary w-auto" type="submit">{{ __('Register') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
