# Laravel Notify
[![Build Status](https://travis-ci.org/Crinsane/LaravelNotify.svg?branch=master)](https://travis-ci.org/Crinsane/LaravelNotify)
[![Total Downloads](https://poser.pugx.org/gloudemans/notify/downloads)](https://packagist.org/packages/gloudemans/notify)
[![License](https://poser.pugx.org/gloudemans/notify/license)](https://packagist.org/packages/gloudemans/notify)

Some helpful tools for getting handy flash notifications on your website
Out of the box support for: Toastr, SweetAlert, Bootbox and native notifications!

# Installation

Install the package through [Composer](http://getcomposer.org/). Require this package with Composer using the following command:

    composer require gloudemans/notify

Next you need to register the package in Laravel by adding the service provider.
To do this open your `config/app.php` file and add a new line to the `providers` array:

	Gloudemans\Notify\LaravelNotifyServiceProvider::class,
	
Now that the package has been registered you can copy the package config file to your local config with the following command:

    artisan vendor:publish --provider="Gloudemans\Notify\LaravelNotifyServiceProvider" --tag="config"
    
Now your all set to use the notification package in your Laravel application.

### Optional

If you'd like to use the `Notification` facade, add a new line to the `aliases` array:

	'Notification' => Gloudemans\Notify\Notifications\NotificationFacade::class,
	
# Usage
	
Using this package is actually pretty easy. Adding notifications to your application actually only requires two steps.

## Adding a notification
First, of course, you need a way to flash the notification to session so they are available on the next request.
If you've injected the `Gloudemans\Notify\Notifications\Notification` class into, for instance, your controller, flashing 
the notification to the session is as easy as this:

    $this->notification->add('success', 'Notification message', 'Notification title');
    
And if you're using the facade it's as easy as:

    Notification::add('success', 'Notification message', 'Notification title');
    
 - The first parameter is the type of notification, the package understand four types of notification: `success`, `info`, `warning` and `error`.
 - The second parameter is the message of the notification.
 - The third *(optional)* parameter is the title of the notification.

To make life even easier there are also four helper methods for different types of notification. So instead of manually supplying
the notification type you can simply call a method with the type as its name:

```php
    $this->notification->success('Success notification');
    $this->notification->info('Info notification');
    $this->notification->warning('Warning notification');
    $this->notification->error('Error notification');
```

Finally you can also add the `Gloudemans\Notify\Notifications\AddsNotifications` trait to your class, which will supply you methods
for adding the notifications:

```php

    use AddsNotifications;
    
    public function yourMethod()
    {
        $this->notify()->success(...); // Also info(), warning(), error()
        $this->notifySuccess(...);
        $this->notifyInfo(...);
        $this->notifyWarning(...);
        $this->notifyError(...);
    }

```

## Displaying the notifications

The second step is to actually show the notifications on your website.
All notifications can be rendered using the `render()` method on `Gloudemans\Notify\Notifications\Notification`.

So a possibility is to add something like this to one of your views:

    <?php app('Gloudemans\Notify\Notifications\Notification')->render(); ?>
    
But if you're like me and don't like code like this in your view there's a nice little Blade directive available:

    @notifications
    
Adding this Blade directive to one of your views give the package a place to render the JavaScript output for rendering
the notifications.

*The recommended location for rendering the notifications is at the bottom of your 'master' layout file*

## Renderers

The packages uses dedicated 'renderer' classes for rendering the notifications. 
Out of the box you can choose between: `native` (default), `toastr`, `sweetalert` and `bootbox`.
To change the renderer that the package uses, simply update the value of `notifications` in the `notifications.php` config file.

The native renderer is the only renderer that doesn't require any extra JavaScript libraries as it uses simple `alert()` functions for showing the notification.

For all the other renderers the necessary scripts and stylesheets are bundled with the package and can be copied to your public directory with the following command:

    artisan vendor:publish --provider="Gloudemans\Notify\LaravelNotifyServiceProvider" --tag="assets"
    
But of course you're free to download them manually or pull them in with another service and include them in your asset build sequence.

*Make sure the scripts are added BEFORE you call the `render()` method*
 
# Extending

If you want to use another library for notifications in your project, that's totally possible!
What you need to do is create your own renderer and change a binding in the service container of Laravel.

Your custom renderer must implement the `Gloudemans\Notify\Notifications\NotificationRenderer` interface, which forces you to implement one simple method:

```php
    /**
     * Render the notifications as HTML/JavaScript
     *
     * @param  array $notifications
     * @return string
     */
    public function render(array $notifications);
```

Once you've created your custom renderer you can bind it to the interface like this:

```php
    $this->app->bind(
        'Gloudemans\Notify\Notifications\NotificationRenderer',
        'App\Renderers\MyCustomRenderer'
    );
```

And that's all you need to do to extend the package with your custom renderer.