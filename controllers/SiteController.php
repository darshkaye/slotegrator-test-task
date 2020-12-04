<?php

namespace app\controllers;

use app\models\Prize;
use app\models\User;
use app\services\PrizesTypes;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Add admin user
     */
    public function actionAddAdmin() {
        $model = User::find()->where(['username' => 'admin'])->one();
        if (empty($model)) {
            $user = new User();
            $user->username = 'admin';
            $user->email = 'admin@dasha.local';
            $user->setPassword('admin');
            $user->generateAuthKey();
            if ($user->save()) {
                echo 'success';
            }
        }
    }

    public function actionGetPrize()
    {
        $prizesTypes = new PrizesTypes();
        $prizeKind = $prizesTypes->randomizeKind();
        $prize = new Prize();
        $params = [
            'user_id' => Yii::$app->user->getId(),
            'kind' => $prizeKind->getPrizeKind(),
            'value' => $prizeKind->randomizePrize(),
            'status' => Prize::STATUS_GENERATED,
        ];
        if ($prize->load($params, '') && $prize->save()) {
            return $this->render(
                'prize_view',
                [
                    'prize' => $prize,
                    'prizeKind' => $prizeKind,
                ]
            );
        }
        //echo"<pre>"; print_r($prize);echo"</pre>";
    }

    public function actionMoneyToLoyalty($id)
    {
        $prize = Prize::findOne(['id' => $id]);
        if ($prize) {
            $prizeType = (new PrizesTypes())->getKindByName($prize->kind);
            if ($prizeType /*&& $prizeType->($prize)*/) {
                echo 'success';
            }
        }
        echo 'fail';
    }

    public function actionRejectPrize($id)
    {
        $prize = Prize::findOne(['id' => $id]);
        if ($prize) {
            $prizeType = (new PrizesTypes())->getKindByName($prize->kind);
            if ($prizeType && $prizeType->rejectPrize($prize)) {
                echo 'successe';
            }
        }
        echo 'fail';
    }

    public function actionApprovePrize($id)
    {
        $prize = Prize::findOne(['id' => $id]);
        if ($prize) {
            $prizeType = (new PrizesTypes())->getKindByName($prize->kind);
            if ($prizeType && $prizeType->approvePrize($prize)) {
                echo 'success';
            }
        }
        echo 'fail';
    }
}
