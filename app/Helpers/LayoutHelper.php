<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class LayoutHelper
{
    public static function byUser(): string
    {
        $layout = 'layouts.default';

        if (Auth::check()) {
            if (Auth::user()->hasRole('admin')) {
                $layout = 'layouts.admin';
            } elseif (Auth::user()->hasRole('customer')) {
                $layout = 'layouts.cabinet';
            }
        }

        return $layout;
    }
}
