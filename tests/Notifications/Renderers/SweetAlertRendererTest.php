<?php

use Gloudemans\Notify\Notifications\Renderers\SweetAlertRenderer;

class SweetAlertRendererTest extends PHPUnit_Framework_TestCase
{

    /**
     * The renderer under test
     *
     * @var \Gloudemans\Notify\Notifications\Renderers\SweetAlertRenderer
     */
    protected $renderer;

    public function setUp()
    {
        $this->renderer = new SweetAlertRenderer();
    }

    /** @test */
    public function it_can_render_a_notification()
    {
        $expected = <<<TAG
<script>
    swal({
        title: 'Notification title',
        text: 'Notification message',
        type: 'success'
    });\n
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
    swal({
        title: 'Success',
        text: 'Notification message',
        type: 'success'
    });\n
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