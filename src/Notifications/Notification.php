<?php

namespace Gloudemans\Notify\Notifications;

use Illuminate\Session\SessionManager;

class Notification
{

    const SESSION_KEY = 'flash-notifications';

    /**
     * Instance of the session manager
     *
     * @var \Illuminate\Session\SessionManager
     */
    private $session;

    /**
     * @var \Gloudemans\Notify\Notifications\NotificationRenderer
     */
    private $renderer;

    /**
     * Construct a new notification manager
     *
     * @param \Illuminate\Session\SessionManager                    $session
     * @param \Gloudemans\Notify\Notifications\NotificationRenderer $renderer
     */
    public function __construct(SessionManager $session, NotificationRenderer $renderer)
    {
        $this->session  = $session;
        $this->renderer = $renderer;
    }

    /**
     * Render the notifications
     *
     * @return string
     */
    public function render()
    {
        $notifications = $this->getNotifications();

        if (empty($notifications)) {
            return;
        }

        return $this->renderer->render($notifications);
    }

    /**
     * Add a new notification to the session
     *
     * @param  string $type
     * @param  string $message
     * @param  null   $title
     * @return void
     */
    public function add($type, $message, $title = null)
    {
        $notifications = $this->getNotifications();

        $notifications[] = [
            'type'    => $type,
            'message' => $message,
            'title'   => $title
        ];

        $this->session->flash(self::SESSION_KEY, $notifications);
    }

    /**
     * Add a new success notifications
     *
     * @param  string $message
     * @param  null   $title
     * @return void
     */
    public function success($message, $title = null)
    {
        $this->add('success', $message, $title);
    }

    /**
     * Add a new info notifications
     *
     * @param  string $message
     * @param  null   $title
     * @return void
     */
    public function info($message, $title = null)
    {
        $this->add('info', $message, $title);
    }

    /**
     * Add a new warning notifications
     *
     * @param  string $message
     * @param  null   $title
     * @return void
     */
    public function warning($message, $title = null)
    {
        $this->add('warning', $message, $title);
    }

    /**
     * Add a new danger notifications
     *
     * @param  string $message
     * @param  null   $title
     * @return void
     */
    public function error($message, $title = null)
    {
        $this->add('error', $message, $title);
    }

    /**
     * Get the notifications from the session
     *
     * @return null|array
     */
    private function getNotifications()
    {
        $notifications = $this->session->get(self::SESSION_KEY);

        return $notifications;
    }

}