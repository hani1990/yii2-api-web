<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$config = [
    'id' => 'backend',
    'timeZone' => 'Asia/Shanghai',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'language' => 'zh-CN',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
//        'urlManager' => [
//            'enablePrettyUrl' => true,
//            'showScriptName' => false,
//            'rules' => [
//                ''=>'site/index'
//            ],
//        ],
        'cache' => [
             'class' => 'yii\caching\FileCache',
            //'class' => 'yii\redis\Cache',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '192.168.191.1',
            'port' => 6380,
            'database' => 0,
            'password'  => 'just4juren',
        ],
        'authManager' => [
            'class' => 'mdm\admin\components\DbManager',
            'db' => 'db',
        ],
        'errorHandler' => [
            'maxSourceLines' => 20,
        ],
    ],
    'modules' => [
//        'admin' => [
//            'class' => 'mdm\admin\Module',
//            'layout' => 'left-menu',
//            'controllerMap' => [
//            ],
//            'menus' => [
//                'assignment' => [
//                    'label' => '角色分配',
//                ],
//                'menu' => [
//                    'label' => '菜单列表',
//                ],
//            ]
//        ],

        'v0' => [
            'class' => 'app\modules\v0\Module',
        ]

    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'paper/*',
           // 'admin/*',
            'user/*',
            'v0/*',
            'route/*',
            'gii/*'
        ]
    ],
    'params' => $params,
];

if( isset($_GET['r'])  && ( ( substr( $_GET['r'], 0, 1 ) == 'v') ||  ( substr($_GET['r'], 0, 5 ) == 'route') )  ){
$config = yii\helpers\ArrayHelper::merge(
    $config,
    \deepziyu\yii\rest\Controller::getConfig()
);
}


return $config;