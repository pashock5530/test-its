<?php

namespace app\controllers;

use app\models\CitiesSearch;
use app\models\Staff;
use app\models\StaffSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
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
     * @inheritdoc
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
     * @return string
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
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
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

    /**
     * ----- NEW -----
     */

    public function actionOne()
    {
        $model = new CitiesSearch();
        $dataProvider = $model->one();

        return $this->render('one', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTwo()
    {
        $model = new StaffSearch();
        $dataProvider = $model->two();

        return $this->render('two', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionThree()
    {
//        $select = (new Query())
//            ->select([
//                '{{%staff}}.name',
//                '{{%cities}}.name as city',
//                '{{%emails}}.name as email',
//                'COUNT({{%staff_phones}}.staff__id) as phone_count',
//            ])
//            ->from('{{%staff}}')
//            ->leftJoin('{{%staff_cities}}' ,'{{%staff}}.id = {{%staff_cities}}.staff__id')
//            ->innerJoin('{{%cities}}' ,'{{%cities}}.id = {{%staff_cities}}.cities__id')
//
//            ->innerJoin('{{%staff_phones}}' ,'{{%staff}}.id = {{%staff_phones}}.staff__id')
//
//            ->leftJoin('{{%staff_emails}}' ,'{{%staff}}.id = {{%staff_emails}}.staff__id')
//            ->innerJoin('{{%emails}}' ,'{{%emails}}.id = {{%staff_emails}}.emails__id')
//
//            ->andHaving(['>', 'phone_count', 1])
//            ->andWhere(['LIKE', '{{%emails}}.name', '%.com', false])
//
//            ->groupBy(['{{%staff}}.id'])
//            ->orderBy(['{{%staff}}.name' => SORT_ASC]);


        $model = new StaffSearch();
        $dataProvider = $model->three();

        return $this->render('three', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionFour()
    {
        $model = new CitiesSearch();
        $dataProvider = $model->four();

        return $this->render('four', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionFive()
    {
        $model = new StaffSearch();
        $dataProvider = $model->five();

        return $this->render('five', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSix()
    {
        $model = new StaffSearch();
        $dataProvider = $model->six();


        return $this->render('six', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
