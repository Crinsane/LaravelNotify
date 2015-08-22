<?php namespace Gloudemans\Notify\Notifications\Renderers;

use Gloudemans\Notify\Escaping;
use Gloudemans\Notify\Notifications\NotificationRenderer;

class BootboxRenderer implements NotificationRenderer
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
        $bootboxes = '';

        foreach ($notifications as $notification) {
            $message = $this->escapeMessage($notification['message']);
            $title = is_null($notification['title']) ? ucfirst($notification['type']) : ucfirst($notification['type']) . ' ' . $this->escapeTitle($notification['title']);
            $type = $notification['type'] == 'error' ? 'danger' : $notification['type'];

            $bootboxes = <<<TAG
    bootbox.dialog({
        message: '{$message}',
        title: '{$title}',
        buttons: {
            success: {
                label: 'OK',
                className: 'btn-{$type}'
            }
        }
    });
TAG;
;
        }

        return $this->renderOutput($bootboxes);
    }

    /**
     * Render the output
     *
     * @param  string $bootboxes
     * @return string
     */
    private function renderOutput($bootboxes)
    {
        $output = <<<TAG
<script>
$bootboxes
</script>
TAG;

        return $output;
    }
}