<?php


namespace Aminin\PassportClient\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Aminin\PassportClient\PassportClient
 */

class PassportClientFacade extends Facade
{
    protected static function getFacadeAccessor() {
        return 'passport.client';
    }
}
