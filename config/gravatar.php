<?php

return  [
    // sets the defaults that the image should be
    // upon generation of the Gravatar URL
    'defaults' => [
        'size'     => 500,
        'width'    => 0,
        'height'   => 0,
        'imageSet' => g_const('MM'),
        'rating'   => g_const('G'),
    ],
    // sets whether or not you wish to use a secure URL
    'secure' => true,
];
