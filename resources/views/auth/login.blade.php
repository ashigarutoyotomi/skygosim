@extends('layouts.app')

@section('content')
    <header-comp
        title="Login"
    ></header-comp>

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

                                    <p class="woocommerce-LostPassword lost_password text-center">
                                        Do not have account |
                                        <a href="{{ route('register') }}">
                                            Register
                                        </a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </article>
                </main>
            </div>
        </div>
    </section>
@endsection
