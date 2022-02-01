<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignUpForm;
use app\models\User_SQL;
use app\models\Country_Model;
use app\models\Debug_to_console;
use yii\data\Pagination;


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
        $user = new User_SQL();
        
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->render('profile',[
                'user'=> $user,
            ]);
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
        $model = new LoginForm();
        Yii::$app->user->logout();

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    // Display Hello World
    public function actionHello()
    {
        return $this->render('hello');
    }

    //Display Profile
    public function actionProfile()
    {
        return $this->render('profile'); 
    }


    public function actionRegister()
{
    $model = new User_SQL();
    $debug = new Debug_to_console();

    if ($model->load(Yii::$app->request->post())) {
        if ($model->validate()) {
            $debug->debug_to_console("validate");
            // form inputs are valid, do something here
            $model->username = $_POST['User_SQL']['username'];
            $model->email = $_POST['User_SQL']['email'];
            $model->password = password_hash($_POST['User_SQL']['password'],PASSWORD_ARGON2I);
            $model->authKey = md5(random_bytes(5));
            $model->accessToken = password_hash(random_bytes(10),PASSWORD_DEFAULT);
            if($model->save()){
                $debug->debug_to_console("save");
                return $this->redirect(['site/login']);
            }
            else{
                $debug->debug_to_console("not save");
            }
        }
    }

    return $this->render('register', [
        'model' => $model,
    ]);
    
}

}
