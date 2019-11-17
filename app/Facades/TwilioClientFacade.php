<?php
namespace App\Facades;

class TwilioClientFacade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'TwilioClient';
    }
}
