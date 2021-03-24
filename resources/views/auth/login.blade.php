@extends('layouts.app')

@section('content')
    <header-comp
        title="Login"
    ></header-comp>

{{--    <login></login>--}}

    <section class="ls s-pt-80 s-pb-70 s-pt-lg-120 s-pb-lg-110 s-pt-xl-160 s-pb-xl-150">
        <div class="container">
            <div class="row">
                <main class="col-lg-12">
                    <article>
                        <div class="entry-content">
                            <div class="woocommerce">
                                <form
                                    class="woocomerce-form woocommerce-form-login login"
                                    method="post"
                                    action="{{ route('login') }}"
                                >
                                    @csrf

                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                        <label for="email">
                                            Email address
                                            <span class="required">*</span>
                                        </label>
                                        <input
                                            type="email"
                                            class="form-control text-center woocommerce-Input woocommerce-Input--text input-text"
                                            name="email"
                                            id="email"
                                            value=""
                                            placeholder="Email address"
                                        >

                                        @error('email')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </p>

                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                        <label
                                            for="password"
                                        >
                                            Password
                                            <span class="required">*</span>
                                        </label>
                                        <input
                                            class="form-control text-center woocommerce-Input woocommerce-Input--text input-text"
                                            type="password"
                                            name="password"
                                            id="password"
                                            placeholder="Password"
                                        >
                                        @error('password')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </p>

                                    <div class="divider-60 d-none d-lg-block"></div>

                                    <p class="form-row text-center">
                                        <button type="submit" class="woocommerce-Button btn btn-maincolor" name="login">
                                            <span>{{ __('Login') }}</span>
                                        </button>
                                        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
                                            <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever">
                                            <span>Remember me</span>
                                        </label>
                                    </p>

                                    @if (Route::has('password.request'))
                                        <p class="woocommerce-LostPassword lost_password text-center">
                                            <a href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        </p>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </article>
                </main>
            </div>
        </div>
    </section>

{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Login') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input--}}
{{--                                    id="email"--}}
{{--                                    type="email"--}}
{{--                                    class="form-control @error('email') is-invalid @enderror"--}}
{{--                                    name="email"--}}
{{--                                    value="{{ old('email') }}"--}}
{{--                                    required autocomplete="email"--}}
{{--                                    autofocus--}}
{{--                                >--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Remember Me') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
