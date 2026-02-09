<?php

return [
    'massage_validate'  => [
        'not_empty' => 'Không để trống trường này... Ngọc Anh à!',
    ],
    
    'images'    => [
        'folderUpload'          => 'public/images/upload/',
        'normalResize_width'    => 750,
        'normalResize_height'   => 460,
        'smallResize_width'     => 400,
        'smallResize_height'    => 250,
        'default_750x460'       => '/images/image-default-750x460.png',
        'default_660x660'       => '/images/image-default-660x660.png',
        /* danh sách action: copy_url, change_name, change_image, delete */
        'keyType'               => '-type-',
        'type'                  => [
            'default'           => ['copy_url', 'change_image'],
            'manager-upload'    => ['copy_url', 'change_name', 'change_image', 'delete']
        ],
        'extension'             => 'webp',
        'quality'               => '90'
    ],
    'sliders'    => [
        'folderUpload'          => 'public/images/slider/'
    ],
    'cache'     => [
        'enable'        => filter_var(env('APP_CACHE_HTML', false), FILTER_VALIDATE_BOOLEAN),
        'folderSave'    => 'public/caches/',
        'extension'     => 'html',
        'disk'          => 'local',
        'ttl'           => (int) env('APP_CACHE_HTML_TIME', 2592000), // đồng bộ APP_CACHE_HTML_TIME (1 tháng)
    ]
];