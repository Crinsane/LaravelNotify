<?php

namespace Gloudemans\Notify\Notifications;

trait AddsNotifications
{

    /**
     * Add a notification
     *
     * @return \Gloudemans\Notify\Notifications\Notification
     */
    public function notify()
    {
        return app('Gloudemans\Notify\Notifications\Notification');
    }

    /**
     * Add a success notification
     *
     * @param  string      $message
     * @param  string|null $title
     * @return void
     */
    public function notifySuccess($message, $title = null)
    {
        return $this->notify()->success($message, $title);
    }

    /**
     * Add an info notification
     *
     * @param  string      $message
     * @param  string|null $title
     * @return void
     */
    public function notifyInfo($message, $title = null)
    {
        return $this->notify()->info($message, $title);
    }

    /**
     * Add a warning notification
     *
     * @param  string      $message
     * @param  string|null $title
     * @return void
     */
    public function notifyWarning($message, $title = null)
    {
        return $this->notify()->warning($message, $title);
    }

    /**
     * Add an error notification
     *
     * @param  string      $message
     * @param  string|null $title
     * @return void
     */
    public function notifyError($message, $title = null)
    {
        return $this->notify()->error($message, $title);
    }
}