<?php

use Gloudemans\Notify\Notifications\Renderers\NativeRenderer;

class NativeRendererTest extends PHPUnit_Framework_TestCase
{

    /**
     * The renderer under test
     *
     * @var \Gloudemans\Notify\Notifications\Renderers\NativeRenderer
     */
    protected $renderer;

    public function setUp()
    {
        $this->renderer = new NativeRenderer();
    }

    /** @test */
    public function it_can_render_a_notification()
    {
        $expected = <<<TAG
<script>
    alert('Success\\n\\nNotification title\\n\\nNotification message');\n
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
    alert('Success\\n\\nNotification message');\n
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