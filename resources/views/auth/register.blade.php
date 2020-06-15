@extends('layouts.frontend.auth')

@section('title','Register')

@section('content')
<div class="py-16 px-5 container">
    <div class="gutter">
        <div class="card">
            <div class="card__header ml-8 py-5 pr-6 flex items-center justify-between border-b border-grey-lightest">
                <h3 class="text-2xl mb-0 leading-tight">Register</h3>
            </div>
            <!-- Form Register-->
            <div class="card__content text-grey-darkest">
                <form method="POST" action="{{ route('register') }}" class="gutter">
                    @csrf
                    <div class="flex flex-wrap">
                        <div class="w-full md:w-1/2 md:pr-8 mb-6">
                            <label for="name">* Your Display Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="input w-full" name="name" id="name" value="{{ old('name') ?: '' }}"
                                    placeholder="{{ __('Name') }}" pattern="[a-zA-Z0-9_-]+{3,55}" maxlength="55" minlength="3"
                                    required autofocus>
                                <div>
                                    {{ $errors->has('name') ?: '' }}
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 md:pr-8 mb-6">
                            <label for="username">* Your Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="input w-full" name="username" id="username" value="{{ old('username') ?: ''}}"
                                    placeholder="{{ __('Username') }}" pattern="[a-zA-Z0-9_-]+{3,32}" maxlength="32"
                                    minlength="3" required />
                                <div>
                                    {{ $errors->has('username') ?: '' }}
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 md:pr-8 mb-6">
                            <label for="email">* E-Mail Address</label>
                            <div class="col-sm-10">
                                <input type="email" class="input w-full name="email" id="email" placeholder="{{ __('E-Mail Address') }}"
                                    value="{{ old('email') ?: ''}}" required />
                                <div>
                                    {{ $errors->has('email') ?: '' }}
                                </div>
                            </div>

                        </div>
                        <div class="w-full md:w-1/2 md:pr-8 mb-6">
                            <label for="password">* Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="input w-full" name="password" id="password" placeholder="{{ __('Password') }}"
                                    required />
                            <div>
                                {{ $errors->has('password') ?: '' }}
                            </div>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 md:pr-8 mb-6">
                            <label for="confirm">* Confirm Password</label>
                            <div class="col-sm-10">
                                    <input type="password" class="input w-full" name="password_confirmation" id="password-confirm"
                                placeholder="{{ __('Confirm Password') }}" required />
                            </div>
                        </div>
                    </div>
                    <div class="mb-8">
                        <button type="submit" name="signup" id="signup" class="btn">Register</button> &nbsp;
                        Already have an account? <a class="text-red hover:text-red-darker transition"
                            href="{{ route('login') }}">Login</a>
                    </div>
                </form>
            </div>
            <!-- /Form Register-->
        </div>
    </div>
</div>
@endsection
