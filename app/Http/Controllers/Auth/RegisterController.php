<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\RegexRule;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        if (Auth::check() && 1 == Auth::user()->role->id) {
            $this->redirectTo = route('admin.dashboard');
        } else {
            $this->redirectTo = route('author.dashboard');
        }
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:55', 'min:3', new RegexRule('/^[a-zA-Z0-9]+([_-]?[a-zA-Z0-9]){3,55}$/')],
            'username' => ['required', 'string', 'min:3', 'max:32', 'unique:users', new RegexRule('/^[a-zA-Z0-9]+([_-]?[a-zA-Z0-9]){3,32}$/')],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'role_id' => 2,
            'name' => $data['name'],
            'username' => Str::slug($data['username']),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
