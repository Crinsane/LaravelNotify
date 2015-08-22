<?php

namespace Gloudemans\Notify\Notifications\Renderers;

use Gloudemans\Notify\Notifications\NotificationRenderer;
use Gloudemans\Notify\Escaping;

class ToastrRenderer implements NotificationRenderer
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
        $output = <<<TAG
<script>
    $toasts
</script>
TAG;

        return $output;
    }

}