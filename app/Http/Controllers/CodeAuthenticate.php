<?php 

namespace App\Http\Middleware;

use Tymon\JWTAuth\Providers\Auth\AuthInterface;
// use Tymon\JWTAuth\Providers\Auth\Illuminate;

class CodeAuthenticate implements AuthInterface
{
    public function byCredentials(array $credentials = [])
    {
        return $credentials['username'] == env('aadk_username') && $credentials['password'] == env('aadk_password');
    }

    public function byId($id)
    {
        // maybe throw an expection?
    }

    public function user()
    {
        // you will have to implement this maybe.
    }
}
