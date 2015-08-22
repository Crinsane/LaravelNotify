<?php

use Gloudemans\Notify\Notifications\Renderers\BootboxRenderer;

class BootboxRendererTest extends PHPUnit_Framework_TestCase
{

    /**
     * The renderer under test
     *
     * @var \Gloudemans\Notify\Notifications\Renderers\BootboxRenderer
     */
    protected $renderer;

    public function setUp()
    {
        $this->renderer = new BootboxRenderer();
    }

    /** @test */
    public function it_can_render_a_notification()
    {
        $expected = <<<TAG
<script>
    bootbox.dialog({
        message: 'Notification message',
        title: 'Success Notification title',
        buttons: {
            success: {
                label: 'OK',
                className: 'btn-success'
            }
        }
    });
</script>
TAG;

        $rendered = $this->renderer->render([
            [
                'type' => 'success',
                'message' => 'Notification message',
                'title' => 'Notification title'
            ]
        ]);

        $this->assertEquals($expected, $rendered);
    }

    /** @test */
    public function it_can_render_a_notification_without_a_title()
    {
        $expected = <<<TAG
<script>
    bootbox.dialog({
        message: 'Notification message',
        title: 'Success',
        buttons: {
            success: {
                label: 'OK',
                className: 'btn-success'
            }
        }
    });
</script>
TAG;

        $rendered = $this->renderer->render([
            [
                'type' => 'success',
                'message' => 'Notification message',
                'title' => null
            ]
        ]);

        $this->assertEquals($expected, $rendered);
    }
}