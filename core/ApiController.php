<?php

namespace core;


use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\Controller;

class ApiController extends Controller
{

    /**
     * @var array
     */
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function checkAccess($action, $model=null, $params=[]) {
        return true;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors[] = [
            'class' => \yii\filters\ContentNegotiator::className(),
            'formatParam' => '_format',
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
                'xml' => \yii\web\Response::FORMAT_XML
            ],
        ];
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['POST', 'PUT', 'OPTIONS', 'GET'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Headers' => ['Authorization'],
                'Access-Control-Max-Age' => 3600,
                'Access-Control-Expose-Headers' => ['*'],
            ],
        ];
//        $behaviors['authenticator'] = [
//            'class' => HttpBasicAuth::className(),
//            'auth' => function($username, $password) {
//                if ($user = User::find()->where(['username' => $username])->one() and
//                    $user->validatePassword($password)) {
//                    return $user;
//                }
//                return null;
//            }
//        ];
//        $behaviors['access'] = [
//            'class' => AccessControl::className(),
//            'rules' => [
//                [
//                    'allow' => true,
//                    'roles' => ['@']
//                ]
//            ],
//        ];

        return $behaviors;
    }
}
