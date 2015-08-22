<?php

namespace Gloudemans\Notify;

trait Escaping
{

    /**
     * Escape the message
     *
     * @param  string $message
     * @return string
     */
    public function escapeMessage($message)
    {
        $message = str_replace("'", "\\'", htmlentities($message));

        return $message;
    }

    /**
     * Escape the title
     *
     * @param  string $title
     * @return string
     */
    public function escapeTitle($title)
    {
        $title = str_replace("'", "\\'", htmlentities($title));

        return $title;
    }
}