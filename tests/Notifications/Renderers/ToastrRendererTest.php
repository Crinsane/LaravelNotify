<?php

use Gloudemans\Notify\Notifications\Renderers\ToastrRenderer;

class ToastrRendererTest extends PHPUnit_Framework_TestCase
{

    /**
     * The renderer under test
     *
     * @var \Gloudemans\Notify\Notifications\Renderers\ToastrRenderer
     */
    protected $renderer;

    public function setUp()
    {
        $this->renderer = new ToastrRenderer();
    }

    /** @test */
    public function it_can_render_a_notification()
    {
        $expected = <<<TAG
<script>
    toastr.success('Notification message', 'Notification title');

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
    toastr.success('Notification message');\n
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