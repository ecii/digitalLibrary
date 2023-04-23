<?php
return [
    'name'=>'Pasaribu\'s DigLab',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules'=>[
        'gridviewKartik'=>[
            'class'=>'\kartik\grid\Module'
        ],
        'gridview'=>[
            'class'=>'\kartik\grid\Module'
        ]
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
    ], 
    'timeZone' => 'Asia/Jakarta'
];
