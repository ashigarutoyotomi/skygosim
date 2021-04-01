@extends('layouts.app')

@section('content')
    <header-comp
        title="Register"
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
                                    action="{{ route('register') }}"
                                >
                                    @csrf

                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                        <label for="first_name">
                                            First Name
                                            <span class="required">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control text-center woocommerce-Input woocommerce-Input--text input-text"
                                            name="first_name"
                                            id="first_name"
                                            value=""
                                            placeholder="First Name"
                                        >

                                        @error('first_name')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </p>

                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                        <label for="last_name">
                                            Last Name
                                            <span class="required">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            class="form-control text-center woocommerce-Input woocommerce-Input--text input-text"
                                            name="last_name"
                                            id="last_name"
                                            value=""
                                            placeholder="Last Name"
                                        >

                                        @error('last_name')
                                        <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </p>

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

                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                        <label for="password-confirm">
                                            {{ __('Confirm Password') }}
                                            <span class="required">*</span>
                                        </label>
                                        <input
                                            type="password"
                                            class="form-control text-center woocommerce-Input woocommerce-Input--text input-text"
                                            name="password_confirmation"
                                            id="password-confirm"
                                            value=""
                                            placeholder="{{ __('Confirm Password') }}"
                                        >
                                    </p>

                                    <div class="divider-60 d-none d-lg-block"></div>

                                    <p class="form-row text-center">
                                        <button type="submit" class="woocommerce-Button btn btn-maincolor" name="login">
                                            <span>{{ __('Register') }}</span>
                                        </button>
                                    </p>
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
{{--                <div class="card-header">{{ __('Register') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('register') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

{{--                                @error('name')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

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
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Register') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
