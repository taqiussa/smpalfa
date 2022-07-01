@extends('layouts.auth')

@section('content')
    <div class="mycontainer">
        <div class="mycard-wrapper">
            <div class="mycontent">
                <h3 class="text-white mb-2">Please Login</h3>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Username</span>
                            <input id="username" name="username" type="text" class="form-control">
                            @error('username')
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
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <button class="btn btn-primary" type="submit">{{ __('Login') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
