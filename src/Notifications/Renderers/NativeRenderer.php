<?php

namespace Gloudemans\Notify\Notifications\Renderers;

use Gloudemans\Notify\Notifications\NotificationRenderer;
use Gloudemans\Notify\Escaping;

class NativeRenderer implements NotificationRenderer
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
        $alerts = '';

        foreach ($notifications as $notification) {
            $message = $this->generateMessage($notification);

            $alerts .= "alert('{$message}');\n";
        }

        return $this->renderOutput($alerts);
    }

    /**
     * Render the output
     *
     * @param  string $alerts
     * @return string
     */
    private function renderOutput($alerts)
    {
        $output = <<<TAG
<script>
    $alerts
</script>
TAG;

        return $output;
    }

    /**
     * Generate the message for a native alert
     *
     * @param  array $notification
     * @return string
     */
    private function generateMessage($notification)
    {
        $message = ucfirst($notification['type']) . '\n\n';

        if ( ! is_null($notification['title'])) {
            $message .= $this->escapeTitle($notification['title']) . '\n\n';
        }

        return $this->escapeMessage($message . $notification['message']);
    }
}