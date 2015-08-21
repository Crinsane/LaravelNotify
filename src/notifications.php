<?php

return [

    'notifications' => [

        /*
        |--------------------------------------------------------------------------
        | Notification Renderer
        |--------------------------------------------------------------------------
        |
        | Specify which renderer to use to render the notifications
        |
        | Supported: "native", "toastr", "sweetalert", "bootbox"
        |
        */
        'renderer' => 'native'

    ],

    'broadcasting' => [

        /*
        |--------------------------------------------------------------------------
        | Broadcasted Notification Renderer
        |--------------------------------------------------------------------------
        |
        | Specify which renderer to use to render the broadcasted notifications
        | When `null` it defaults to the same renderer as normal notifications
        |
        | Supported: "native", "toastr", "sweetalert", "bootbox"
        |
        */
        'renderer' => null,

        /*
        |--------------------------------------------------------------------------
        | Broadcasting channel
        |--------------------------------------------------------------------------
        |
        | The channel on which to broadcast the notifications
        |
        */
        'channel' => 'notifications',

    ]

];