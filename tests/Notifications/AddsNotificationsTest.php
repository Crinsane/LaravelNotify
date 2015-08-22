<?php

namespace Gloudemans\Notify\Notifications {

    use Mockery as m;

    function app()
    {
        return m::mock('Gloudemans\Notify\Notifications\Notification');
    }


    class AddsNotificationsTest extends \PHPUnit_Framework_TestCase
    {

        /**
         * @var ControllerStub
         */
        protected $controller;

        public function setUp()
        {
            $this->controller = $this->getObjectForTrait('Gloudemans\Notify\Notifications\AddsNotifications');
        }

        /** @test */
        public function it_has_access_to_a_method_that_returns_an_instance_of_the_notification_class()
        {
            $notify = $this->controller->notify();

            $this->assertInstanceOf('Gloudemans\Notify\Notifications\Notification', $notify);
        }
    }
}