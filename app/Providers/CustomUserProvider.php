<?php

namespace App\Providers;

use App\Models\User;
use Throwable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class CustomUserProvider implements UserProvider
{
    public function retrieveByToken ($identifier, $token) {
        throw new Throwable('Method not implemented.');
    }

    public function updateRememberToken (Authenticatable $user, $token) {
        throw new Throwable('Method not implemented.');
    }

    public function retrieveById ($identifier) {
        return $this->getMemberInstance($identifier);
    }

    public function retrieveByCredentials (array $credentials) {
        return $this->getMemberInstance($credentials);
    }

    public function validateCredentials (Authenticatable $user, array $credentials) {
        return true;
    }

    private function getMemberInstance ($credentials) {

        if ($credentials['aadk_username'] === env('AADK_USERNAME') && $credentials['aadk_password'] === env('AADK_PASSWORD')) {
            return tap(new User(), function ($user) use ($credentials) {
                $user->id = 1;
                // $user->user = (string) "abc";
                // $user->custom_data = get_custom_data();
                // $user->id = $phone;
                // $user->phone = (string) $phone;
                // $user->custom_data = get_custom_data();
                // push whatever your require from user
                // Don't save the model instance here
                // As we won't use any stroage.
            });
        } else {
            return null;
        }

        
    }
}