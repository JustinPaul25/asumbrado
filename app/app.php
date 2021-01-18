<?php

namespace App;

use Illuminate\Support\Facades\URL;

class App 
{
    public static function get()
    {
        return [
            'is_admin' => auth()->check() ? auth()->user()->isAdmin() : false,
            'is_mid' => auth()->check() ? auth()->user()->isMid() : false,
            'is_view_only' => auth()->check() ? auth()->user()->isViewOnly() : false,
            'user' => auth()->check() ? auth()->user() : false,
        ];
    }
}