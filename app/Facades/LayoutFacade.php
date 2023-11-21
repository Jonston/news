<?php

namespace App\Facades;

use App\Helpers\LayoutHelper;
use Illuminate\Support\Facades\Facade;

class LayoutFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return LayoutHelper::class;
    }
}
