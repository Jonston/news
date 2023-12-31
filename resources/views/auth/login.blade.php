@extends('layouts.auth')

@section('content')
    <div class="form-container mt-5 bg-light">
        <h4>Login Form</h4>
        <form method="post" action="{{ route('login') }}" novalidate>
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input name="email"
                       type="email"
                       class="form-control @if($errors->has('email')) is-invalid @endif"
                       id="email"
                />
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password"
                       type="password"
                       class="form-control @if($errors->has('password')) is-invalid @endif"
                       id="password"
                />
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>
            <div class="mb-3 form-check">
                <input name="remember"
                       type="checkbox"
                       class="form-check-input @if($errors->has('remember')) is-invalid @endif"
                       id="remember"
                       value="1"
                >
                <label class="form-check-label" for="remember">remember</label>
                @if($errors->has('remember'))
                    <div class="invalid-feedback">
                        {{ $errors->first('remember') }}
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
