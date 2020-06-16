@extends('layouts.app')

@section('content')
    <div class="kt-grid kt-grid--ver kt-grid--root kt-page">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile bg-white">

                <div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside" style="min-height: 300px;background-image: url({{asset('assets/media/bg/bg-4.jpg')}});">

                    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
                        <div class="kt-grid__item kt-grid__item--middle">
                            <h3 class="kt-login__title">Ласкаво просимо до CRM!</h3>
                            {{--<h4 class="kt-login__subtitle">The ultimate Bootstrap & Angular 6 admin theme framework for next generation web apps.</h4>--}}
                        </div>

                    </div>
                    <div class="kt-grid__item">
                        <div class="kt-login__info">
                            <div class="kt-login__copyright">
                                {{ date('Y') }} &nbsp;&copy;&nbsp;<a href="https://i-bionic.com/" target="_blank" class="kt-link">IBionic Group</a>
                            </div>
                            {{--<div class="kt-login__menu">--}}
                                {{--<a href="#" class="kt-link">Privacy</a>--}}
                                {{--<a href="#" class="kt-link">Legal</a>--}}
                                {{--<a href="#" class="kt-link">Contact</a>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>

                <!--begin::Aside-->

                <!--begin::Content-->
                <div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper">

                    <!--begin::Head-->
                    {{--<div class="kt-login__head">--}}
                        {{--<span class="kt-login__signup-label">Don't have an account yet?</span>&nbsp;&nbsp;--}}
                        {{--<a href="#" class="kt-link kt-login__signup-link">Sign Up!</a>--}}
                    {{--</div>--}}

                    <!--end::Head-->

                    <!--begin::Body-->
                    <div class="kt-login__body">

                        <!--begin::Signin-->
                        <div class="kt-login__form">
                            <div class="kt-grid__item mb-5">
                                <a class="kt-login__logo text-white">
                                    <img alt="Logo" src="{{asset('assets/logo.jpg')}}" class="img-fluid">
                                </a>
                            </div>
                            <div class="kt-login__title">
                                <h3>Вхід в адмін панель</h3>
                            </div>

                            <!--begin::Form-->
                            <form method="POST" class="kt-form" action="{{ route('login') }}">
                                @csrf
                                <div class="input-group form-group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Введіть Email" required autocomplete="email" autofocus name="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="input-group form-group">
                                    <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" placeholder="Введіть пароль" name="password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="kt-login__actions">
                                    {{--<label class="kt-link kt-login__link-forgot">--}}
                                        {{--<input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="custom-control-input">--}}
                                        {{--Запам'ятати мене--}}
                                        {{--<span></span>--}}
                                    {{--</label>--}}
                                    <button type="submit" class="btn btn-primary btn-elevate kt-login__btn-primary mx-auto">Ввійти</button>
                                </div>

                                {{--<div class="row kt-login__extra">--}}
                                    {{--<div class="col">--}}
                                        {{--<label class="kt-checkbox">--}}
                                            {{--<input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="custom-control-input">--}}
                                            {{--Запам'ятати мене--}}
                                            {{--<span></span>--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="col kt-align-right">--}}
                                    {{--<a href="javascript:;" id="kt_login_forgot" class="kt-link kt-login__link">Забули пароль?</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="kt-login__actions">--}}
                                    {{--<button type="submit" id="kt_login_signin_submit" class="btn btn-pill kt-login__btn-primary">Ввійти</button>--}}
                                {{--</div>--}}
                            </form>

                            {{--<form class="kt-form" action="" novalidate="novalidate" id="kt_login_form">--}}
                                {{--<div class="form-group">--}}
                                    {{--<input class="form-control" type="text" placeholder="Username" name="username" autocomplete="off">--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<input class="form-control" type="password" placeholder="Password" name="password" autocomplete="off">--}}
                                {{--</div>--}}

                                {{--<!--begin::Action-->--}}
                                {{--<div class="kt-login__actions">--}}
                                    {{--<a href="#" class="kt-link kt-login__link-forgot">--}}
                                        {{--Forgot Password ?--}}
                                    {{--</a>--}}
                                    {{--<button id="kt_login_signin_submit" class="btn btn-primary btn-elevate kt-login__btn-primary">Sign In</button>--}}
                                {{--</div>--}}

                                {{--<!--end::Action-->--}}
                            {{--</form>--}}

                            <!--end::Form-->

                            <!--begin::Divider-->
                            {{--<div class="kt-login__divider">--}}
                                {{--<div class="kt-divider">--}}
                                    {{--<span></span>--}}
                                    {{--<span>OR</span>--}}
                                    {{--<span></span>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <!--end::Divider-->

                            <!--begin::Options-->
                            {{--<div class="kt-login__options">--}}
                                {{--<a href="#" class="btn btn-primary kt-btn">--}}
                                    {{--<i class="fab fa-facebook-f"></i>--}}
                                    {{--Facebook--}}
                                {{--</a>--}}
                                {{--<a href="#" class="btn btn-info kt-btn">--}}
                                    {{--<i class="fab fa-twitter"></i>--}}
                                    {{--Twitter--}}
                                {{--</a>--}}
                                {{--<a href="#" class="btn btn-danger kt-btn">--}}
                                    {{--<i class="fab fa-google"></i>--}}
                                    {{--Google--}}
                                {{--</a>--}}
                            {{--</div>--}}

                            <!--end::Options-->
                        </div>

                        <!--end::Signin-->
                    </div>

                    <!--end::Body-->
                </div>

                <!--end::Content-->
            </div>
        </div>
    </div>
@endsection
