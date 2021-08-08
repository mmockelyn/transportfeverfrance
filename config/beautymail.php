<?php

return [

    // These CSS rules will be applied after the regular template CSS

    /*
        'css' => [
            '.button-content .button { background: red }',
        ],
    */

    'colors' => [

        'highlight' => '#004ca3',
        'button'    => '#004cad',

    ],

    'view' => [
        'senderName'  => env("MAIL_FROM_NAME"),
        'reminder'    => null,
        'unsubscribe' => null,
        'address'     => env("MAIL_FROM_ADDRESS"),

        'logo'        => [
            'path'   => '%PUBLIC%/storage/files/shares/core/logo_couleur.png',
            'width'  => '',
            'height' => '',
        ],

        'twitter'  => 'https://twitter.com/T_FeverFR',
        'facebook' => 'https://www.facebook.com/groups/TransportFeverFR',
        'flickr'   => null,
    ],

];
