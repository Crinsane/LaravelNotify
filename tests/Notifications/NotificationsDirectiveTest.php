<?php

use Illuminate\View\Compilers\BladeCompiler;
use Mockery as m;

class NotificationsDirectiveTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_compiles_the_blade_notifications_directive_to_php()
    {
        $compiler = new BladeCompiler(
            m::mock('Illuminate\Filesystem\Filesystem'), __DIR__
        );

        $this->registerBladeDirective($compiler);

        $result = $compiler->compileString('@notifications');
        $expected = '<?php echo app(\'Gloudemans\Notify\Notifications\Notification\')->render(); ?>';

        $this->assertEquals($expected, $result);
    }

    /**
     * Register the custom Blade directive
     *
     * @param \Illuminate\View\Compilers\BladeCompiler $compiler
     */
    private function registerBladeDirective($compiler)
    {
        $compiler->directive('notifications', function () {
            $expression = 'Gloudemans\Notify\Notifications\Notification';

            return "<?php echo app('{$expression}')->render(); ?>";
        });
    }
}