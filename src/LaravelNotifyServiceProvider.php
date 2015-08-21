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
        ]);

        $this->app['view']->getEngineResolver()->resolve('blade')->getCompiler()->directive('notifications',
            function () {
                $expression = 'Gloudemans\Notify\Notifications\Notification';

                return "<?php echo app('{$expression}')->render(); ?><script>
        var socket = io('http://192.168.10.10:6001');
        socket.on('notifications:Gloudemans\\Notify\\Broadcasting\\BroadcastNotification', function(message){
            console.log(message);
        });
    </script>";
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
}
