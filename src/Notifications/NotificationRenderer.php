<?php

namespace Gloudemans\Notify\Notifications;

interface NotificationRenderer
{

    /**
     * Render the notifications as html
     *
     * @param  array $notifications
     * @return string
     */
    public function render(array $notifications);

}