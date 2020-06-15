<?php

namespace App\Services;

use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Laravel\Socialite\Facades\Socialite;
use Session;
use URL;

class SocialAccountService
{
    protected $providers = [
        'github', 'facebook', 'google', 'twitter',
    ];

    public function redirectToProvider($driver)
    {
        if (!$this->isProviderAllowed($driver)) {
            return $this->sendFailedResponse("{$driver} is not currently supported");
        }

        try {
            // get previous URL
            intendedURL();

            return Socialite::driver($driver)->redirect();
        } catch (\Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }
    }

    public function handleProviderCallback($driver)
    {
        try {
            $user = Socialite::driver($driver)->user();
        } catch (\Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }

        // check for email in returned user
        return empty($user->email) ? $this->sendFailedResponse("No email id returned from {$driver} provider.") : $this->createOrGetUser($user, $driver);
    }

    public function createOrGetUser(ProviderUser $providerUser, $provider)
    {
        $providerUser_id = $providerUser->getId();
        $providerUser_avatar = $providerUser->getAvatar();
        $providerUser_email = $providerUser->getEmail();
        $account = SocialAccount::whereProviderName($provider)
            ->whereProviderId($providerUser_id)->first();

        if ($account) {
            // update info of Social model
            $account->update(
                [
                    'avatar' => $providerUser_avatar,
                    'provider_id' => $providerUser_id,
                ]
            );
            // also update info of User
            $account->user->update([
                'email' => $providerUser_email,
            ]);

            // function user() of SocialAccount Model
            return $this->loginUser($account->user);
        }
        $verify_user = null;
        $user = User::whereEmail($providerUser_email)->first();

        if ($user) {
            $verify_user = $user;
            $socialAccount = new SocialAccount();
            $socialAccount->provider_id = $providerUser_id;
            $socialAccount->provider_name = $provider;
            $socialAccount->avatar = $providerUser_avatar;

            // update user info
            $user->identity()->update($socialAccount);
        } else {
            // create a new user
            $user = User::create([
                'username' => $providerUser_email,
                'email' => $providerUser_email,
                'name' => $providerUser->getName(),
                'email_verified_at' => Carbon::now(),
            ]);
            $verify_user = $user;

            // linked user info
            $socialAccount = new SocialAccount();
            $socialAccount->provider_id = $providerUser_id;
            $socialAccount->provider_name = $provider;
            $socialAccount->avatar = $providerUser_avatar;

            $user->identity()->save($socialAccount);
        }

        return $this->loginUser($verify_user);
    }

    protected function loginUser($user)
    {
        Auth::login($user, true);

        return $this->sendSuccessResponse();
    }

    protected function sendSuccessResponse()
    {
        return  redirect(Session::get('pre_url'));
        // return back();
        // return redirect()->intended('home');
    }

    protected function sendFailedResponse($msg = null)
    {
        return redirect()->route('login')
            ->with('error', $msg ?: 'Unable to login, try with another provider to login.');
    }

    protected function isProviderAllowed($driver)
    {
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }
}
