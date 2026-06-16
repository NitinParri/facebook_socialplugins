<?php

declare(strict_types=1);

$EM_CONF[$_EXTKEY] = [
    'title'            => 'Facebook Social Plugins',
    'description'      => 'Facebook Social Plugins - All Social Plugins from Facebook (https://developers.facebook.com/docs/plugins/)',
    'category'         => 'plugin',
    'author'           => 'Nitin Parri',
    'author_email'     => 'nitin@refresj.nl',
    'author_company'   => 'Refresj',
    'state'            => 'stable',
    'version'          => '14.3.0',
    'constraints'      => [
        'depends'   => [
            'php'   => '^8.5',
            'typo3' => '14.3.0-14.99.99',
        ],
        'conflicts' => [],
        'suggests'  => [],
    ],
];
