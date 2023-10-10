@extends('admin.layout', ['disable_layout' => true])
@section('title', __('admin/main.login'))


@section('content')
    <div class="row d-flex align-items-center  justify-content-center" style="min-height: 100vh;">
        <div class="col-sm-6">
            <div class="card  ">
                <div class="card-body">
                    @if (\Session::has('error'))
                        <div class="alert alert-danger">
                            <li> {{ __('admin/main.wrong-email-or-password') }} </li>
                        </div>
                    @endif
                    {{ old('email') }}
                    <form method="POST" action="{{ route('admin.authenticate') }}">
                        @csrf
                        <h2>{{ __('admin/main.login') }}</h2>
                        <label class="sr-only" for="">{{ __('admin/main.email-address') }}</label>
                        <input class="form-control" type="email" name="email" value="{{ old('email') }}"
                            placeholder="{{ __('admin/main.email-address') }}" required autofocus>
                        <label class="sr-only" for="">{{ __('admin/main.password') }}</label>
                        <input class="form-control" type="password" name="password" value="{{ old('password') }}"
                            placeholder="{{ __('admin/main.password') }}" required>
                        <p class="checkbox">
                            <label><input type="checkbox" name="remember" value="true">
                                {{ __('admin/main.remember-me') }} </label>
                        </p>
                        <button class="btn btn-primary btn-block" type="sumbit">{{ __('admin/main.sign-in') }}</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection
