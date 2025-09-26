<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


if (!function_exists('setSidebar')) {
    function setSidebar(array $routes)
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) {
                return 'active';
            }
        }
        return '';
    }
}



if (!function_exists('isApprovedUser')) {
    function isApprovedUser()
    {
        $user = Auth::user();
        return $user && $user->is_approved;
    }
}
