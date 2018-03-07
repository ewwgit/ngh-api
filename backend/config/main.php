<?php
date_default_timezone_set("Asia/Kolkata");
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
    		
    		'nursinghomes' => [
    				'class' => 'app\modules\nursinghomes\nursinghomes',
    		],
    		'doctors' => [
    				'class' => 'app\modules\doctors\doctors',
    		],
    		'specialities' => [
    				'class' => 'app\modules\specialities\specialities',
    		],
    		'qualifications' => [
    				'class' => 'app\modules\qualifications\qualifications',
    		],
    		'role' => [
    				'class' => 'backend\modules\role\Role',
    		],
    		'user' => [
    				'class' => 'backend\modules\user\user',
    		],
    		'intresteddoctors' => [
    				'class' => 'app\modules\intresteddoctors\intresteddoctors',
    		],
    		'intrestednursinghomes' => [
    				'class' => 'app\modules\intrestednursinghomes\Intrestednursinghomes',
    		],
    		'patients' => [
    				'class' => 'app\modules\patients\patients',
    		],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
    		'response' => [
    				'format' => yii\web\Response::FORMAT_JSON,
    				'charset' => 'UTF-8',
    		],
    		'request' => [
    				'class' => '\yii\web\Request',
    				'enableCookieValidation' => false,
    				'enableCsrfValidation' => false,
    				'parsers' => [
    						'application/json' => 'yii\web\JsonParser',
    				],
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
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
