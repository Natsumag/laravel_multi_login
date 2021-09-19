<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Routing\Route;

class Authenticate extends Middleware
{
    protected $owner_route = 'owner.login';
    protected $admin_route = 'admin.login';
    protected $user_route = 'user.login';
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if(Route::is('owner.*')) {
                return route($this->owner_route);
            } elseif(Route::is('admin.*')) {
                return \route($this->admin_route);
            } else {
                return \route($this->user_route);
            }

        }
    }
}
