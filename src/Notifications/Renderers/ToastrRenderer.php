<?php

namespace Gloudemans\Notify\Notifications\Renderers;

use Gloudemans\Notify\Notifications\NotificationRenderer;
use Gloudemans\Notify\Escaping;

class ToastrRenderer implements NotificationRenderer
{

    use Escaping;

    /**
     * Render the notifications as html
     *
     * @param  array $notifications
     * @return string
     */
    public function render(array $notifications)
    {
        $toasts = '';

        foreach ($notifications as $notification) {
            $message = $this->escapeMessage($notification['message']);

            $toasts .= "toastr.{$notification['type']}('{$message}'";

            if ( ! is_null($notification['title'])) {
                $title = $this->escapeTitle($notification['title']);

                $toasts .= ", '{$title}'";
            }

            $toasts .= ");\n";
        }

        return $this->renderOutput($toasts);
    }

    /**
     * Render the output
     *
     * @param  string $toasts
     * @return string
     */
    private function renderOutput($toasts)
    {
        $setup = $this->generateSetup();

        $output = <<<TAG
<script>
    $setup
    $toasts
</script>
TAG;

        return $output;
    }

    private function generateSetup()
    {
        return <<<TAG
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "400",
        "hideDuration": "1000",
        "timeOut": "7000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
TAG;
    }

}