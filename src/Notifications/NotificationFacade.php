<?php

namespace Gloudemans\Notify\Notifications;

use Illuminate\Support\Facades\Facade;

class NotificationFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Gloudemans\Notify\Notifications\Notification';
    }

}