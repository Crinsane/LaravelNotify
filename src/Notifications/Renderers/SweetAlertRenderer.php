<?php

namespace Gloudemans\Notify\Notifications\Renderers;

use Gloudemans\Notify\Notifications\NotificationRenderer;
use Gloudemans\Notify\Escaping;

class SweetAlertRenderer implements NotificationRenderer
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
        $sweetAlerts = '';

        foreach ($notifications as $notification) {
            $message = $this->escapeMessage($notification['message']);
            $type    = $notification['type'];
            $title   = is_null($notification['title']) ? ucfirst($type) : $this->escapeTitle($notification['title']);

            $sweetAlerts .= "swal({\n";
            $sweetAlerts .= "title: '{$title}',";
            $sweetAlerts .= "text: '{$message}',\n";
            $sweetAlerts .= "type: '{$type}',\n";
            $sweetAlerts .= "});\n";
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