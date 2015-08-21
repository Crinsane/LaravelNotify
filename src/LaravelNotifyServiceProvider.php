<?php

namespace Gloudemans\Notify;

use Illuminate\Support\ServiceProvider;

class LaravelNotifyServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/notifications.php' => config_path('notifications.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../resources/css' => public_path('css'),
            __DIR__.'/../resources/js' => public_path('js'),
        ], 'assets');

        $this->getBladeCompiler()
            ->directive('notifications', function () {
                $expression = 'Gloudemans\Notify\Notifications\Notification';

                return "<?php echo app('{$expression}')->render(); ?>";
            });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/notifications.php', 'notifications'
        );

        $config = $this->app['config']->get('notifications');

        $this->bindNotificationRenderer($config['notifications']['renderer']);
    }

    /**
     * Bind the notification renderer specificed in the configuration
     * to the NotificationRenderer interface
     *
     * @param  string $renderer
     * @return void
     */
    private function bindNotificationRenderer($renderer)
    {
        $renderer = ucfirst($renderer);

        $this->app->bind(
            'Gloudemans\Notify\Notifications\NotificationRenderer',
            "Gloudemans\\Notify\\Notifications\\Renderers\\{$renderer}Renderer"
        );
    }

    /**
     * Get the blade compiler
     *
     * @return \Illuminate\View\Compilers\CompilerInterface
     */
    private function getBladeCompiler()
    {
        return $this->app['view']
            ->getEngineResolver()
            ->resolve('blade')
            ->getCompiler();
    }
}
