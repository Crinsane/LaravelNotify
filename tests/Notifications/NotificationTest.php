<?php

use Gloudemans\Notify\Notifications\Notification;
use Mockery as m;

class NotificationTest extends PHPUnit_Framework_TestCase
{

    protected $session;

    protected $renderer;

    protected $notification;

    public function setUp()
    {
        $this->session = m::mock('Illuminate\Session\SessionManager');
        $this->renderer = m::mock('Gloudemans\Notify\Notifications\NotificationRenderer');

        $this->notification = new Notification($this->session, $this->renderer);
    }

    /** @test */
    public function it_can_add_a_notification_to_the_session()
    {
        $this->session->shouldReceive('get')->once();
        $this->session->shouldReceive('flash')->once();

        $this->notification->add('success', 'Notification message', 'Notification title');
    }

    /** @test */
    public function it_can_add_a_notification_without_a_title_to_the_session()
    {
        $this->session->shouldReceive('get')->once();
        $this->session->shouldReceive('flash')->once();

        $this->notification->add('success', 'Notification message');
    }

    /** @test */
    public function it_can_add_a_success_notification()
    {
        $this->addNotification('success');
    }

    /** @test */
    public function it_can_add_an_info_notification()
    {
        $this->addNotification('info');
    }

    /** @test */
    public function it_can_add_a_warning_notification()
    {
        $this->addNotification('warning');
    }

    /** @test */
    public function it_can_add_a_error_notification()
    {
        $this->addNotification('error');
    }

    /** @test */
    public function it_can_render_the_notifications()
    {
        $notifications = [
            [
                'type' => 'success',
                'message' => 'Notification message',
                'title' => 'Notification title'
            ]
        ];

        $this->session->shouldReceive('get')->once()->andReturn($notifications);

        $this->renderer->shouldReceive('render')->once()->with($notifications)->andReturn($notifications);

        $rendered = $this->notification->render();

        $this->assertEquals($notifications, $rendered);
    }

    /** @test */
    public function it_does_not_render_anything_if_no_notifications_where_set()
    {
        $this->session->shouldReceive('get')->once()->andReturn(null);

        $this->renderer->shouldReceive('render')->once()->with(null)->andReturn(null);

        $rendered = $this->notification->render();

        $this->assertNull($rendered);
    }

    /**
     * Helper method for adding a notification
     *
     * @param string $type
     */
    private function addNotification($type)
    {
        $message = 'Notification message';
        $title = 'Notification title';

        $this->session->shouldReceive('get')->once();
        $this->session->shouldReceive('flash')->once()->with(Notification::SESSION_KEY, [[
            'type'    => $type,
            'message' => $message,
            'title'   => $title
        ]]);

        $this->notification->{$type}($message, $title);
    }
}