<?php
return [
    'version' => [
        'prefix'       => 'v',
        'longPrefix'   => 'version',
        'description'  => 'Show Gerdr\'s version',
        'required'     => false,
        'noValue'      => true,
    ],
    'dom' => [
        'prefix'      => 'd',
        'longPrefix'  => 'dom',
        'description' => 'The DOM to parse',
        'required'    => true,
    ],
    'seek-config-file' => [
        'prefix'      => 'c',
        'longPrefix'  => 'seek-config-file',
        'description' => 'Seek configuration file (see the project\'s wiki)',
        'required'    => true,
    ],
    'signed-actions' => [
        'prefix'      => 's',
        'longPrefix'  => 'signed-actions',
        'description' => 'Prepend the altered/removed DOM node with a comment',
        'required'    => false,
        'noValue'     => true,
    ]
];
