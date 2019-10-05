<?php
return [
    'version' => [
        'prefix'       => 'v',
        'longPrefix'   => 'version',
        'description'  => 'Show Gerdr\'s version',
        'required'     => FALSE,
        'noValue'      => TRUE,
    ],
    'dom' => [
        'prefix'      => 'd',
        'longPrefix'  => 'dom',
        'description' => 'The DOM to parse',
        'required'    => TRUE,
    ],
    'seek-config-file' => [
        'prefix'      => 'c',
        'longPrefix'  => 'seek-config-file',
        'description' => 'Seek configuration file (see the project\'s wiki)',
        'required'    => TRUE,
    ],
    'signed-actions' => [
        'prefix'      => 's',
        'longPrefix'  => 'signed-actions',
        'description' => 'Prepend the altered/removed DOM node with a comment',
        'required'    => FALSE,
        'noValue'     => TRUE,
    ]
];
