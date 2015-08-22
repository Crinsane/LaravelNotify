<?php

namespace Gloudemans\Notify\Notifications\Renderers;

use Gloudemans\Notify\Notifications\NotificationRenderer;
use Gloudemans\Notify\Escaping;

class SweetAlertRenderer implements NotificationRenderer
{

    use Escaping;

    /**
     * Render the notifications as HTML/JavaScript
     *
     * @param  array $notifications
     * @return string
     */
    public function render(array $notifications)
    {
        $sweetAlerts = '';

        foreach ($notifications as $notification) {
            $message = $this->escapeMessage($notification['message']);
            $type    = $notification['type'];
            $title   = is_null($notification['title']) ? ucfirst($type) : $this->escapeTitle($notification['title']);

            $sweetAlerts = <<<TAG
    swal({
        title: '{$title}',
        text: '{$message}',
        type: '{$type}'
    });\n
TAG;
        }

        return $this->renderOutput($sweetAlerts);
    }

    /**
     * Render the output
     *
     * @param  string $sweetAlerts
     * @return string
     */
    private function renderOutput($sweetAlerts)
    {
        $output = <<<TAG
<script>
$sweetAlerts
</script>
TAG;

        return $output;
    }

}