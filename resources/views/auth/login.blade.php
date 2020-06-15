@extends('layouts.frontend.app')

@section('title','Login')

@section('content')
<div class="py-16 px-5 container">
    <div class="gutter">
        <div class="card">
            <div class="card__header ml-8 py-5 pr-6 flex items-center justify-between border-b border-grey-lightest">
                <h3 class="text-2xl mb-0 leading-tight">Login</h3>
            </div>
            <div class="card__content">
                <form method="POST" action="{{ route('login') }}" class="gutter">
                    @csrf
                    <div class="form__item md-col-7">
                        <label class="text-grey-darkest" for="login">E-Mail Address</label>
                        <div class="col-sm-10 pr-8 mb-6">
                            <input name="login" id="login" type="text" class="input w-full" autofocus
                                value="{{ old('username') ?: old('email') }}">
                            <div>
                                @if ($errors->has('username') || $errors->has('email'))
                                <span class="label text-xs text-grey-darker mt-1">
                                    <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form__item md-col-7">
                        <label class="text-grey-darkest" for="password">Password</label>
                        <div class="col-sm-10 pr-8 mb-6">
                            <input type="password" id="password" class="input w-full" name="password">
                        </div>
                        <div>
                            @if ($errors->has('password'))
                            <span class="label text-xs text-grey-darker mt-1">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form__item md-col-7 mb-6 text-grey-darkest">
                        <input type="checkbox" id="remember" name="remember" value="1" {{ old('remember') ? 'checked' : '' }} class="inline-block w-auto mr-3">
                        <label for="remember">Remember Me</label>
                    </div>
                    <div class="form__item mb-8 text-grey-darkest md:flex items-center">
                        <button type="submit" name="signin" id="signin" class="inline-block btn mb-4 md:mb-0 mr-2">Login</button> &nbsp;
                        <div>
                            <a class="text-red hover:text-red-darker transition whitespace-no-wrap"
                                href="{{ route('password.request') }}">Forgot Your Password</a> or
                            <a class="text-red hover:text-red-darker transition whitespace-no-wrap"
                                href="{{ route('register') }}">Need to register?</a>
                        </div>
                    </div>
                    <div>
                        <label class="text-grey-darkest">Or Login with</label>
                        <ul class="list-none pl-0 form__item mb-8 text-grey-darkest md:flex items-center">
                            <li><a rel="nofollow" href="{{ route('social.redirect', 'google') }}" class="rounded-full flex items-center justify-center m-3 p-3 text-white bg-red-darker hover:bg-black transition">
                                    <svg class="w-5 h-5 block">
                                        <use xlink:href="#icon-googleplus"></use>
                                    </svg>
                                </a>
                            </li>
                            <li><a rel="nofollow" href="{{ route('social.redirect', 'facebook') }}" class="rounded-full flex items-center justify-center m-3 p-3 text-white bg-facebook hover:bg-black transition">
                                    <svg class="w-5 h-5 block">
                                        <use xlink:href="#icon-facebook"></use>
                                    </svg>
                                </a>
                            </li>
                            <li><a rel="nofollow" href="{{ route('social.redirect', 'twitter') }}" class="rounded-full flex items-center justify-center m-3 p-3 text-white bg-twitter hover:bg-black transition">
                                <svg class="w-5 h-5 block">
                                    <use xlink:href="#icon-twitter"></use>
                                </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection