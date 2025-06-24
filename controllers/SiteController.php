<?php

namespace app\controllers;

use app\models\Article;
use app\models\User;
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
                'class' => AccessControl::class,
                'only' => ['signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            // Проверка, что пользователь администратор
                            return !Yii::$app->user->isGuest && Yii::$app->user->identity->is_admin;
                        },
                    ],
                    [
                        'actions' => ['signup'],
                        'allow' => false, // Явный запрет для всех остальных
                        'roles' => ['?', '@'],
                        'denyCallback' => function ($rule, $action) {
                            if (Yii::$app->user->isGuest) {
                                return Yii::$app->getResponse()->redirect(['site/login']);
                            }
                            throw new ForbiddenHttpException('Доступ только для администраторов');
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
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
        $q = Yii::$app->request->get('q', '');

        $query = Article::find()->orderBy(['created_at' => SORT_DESC]);

        if (!empty(trim($q))) {
            $words = array_filter(explode(' ', $q), function($word) {
                return mb_strlen(trim($word)) > 2;
            });

            if (!empty($words)) {
                $conditions = ['or'];
                foreach ($words as $word) {
                    $conditions[] = ['like', 'title', $word];
                    $conditions[] = ['like', 'content', $word];
                }
                $query->andWhere($conditions);
            }
        }

        $latestArticles = $query->limit(3)->all();

        return $this->render('index', [
            'latestArticles' => $latestArticles,
            'searchQuery' => $q
        ]);
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

    public function actionSignup()
    {
        if (Yii::$app->user->isGuest || !Yii::$app->user->identity->is_admin) {
            throw new \yii\web\ForbiddenHttpException('Доступ только для администраторов');
        }

        $model = new User();
        $model->scenario = 'create';

        if ($model->load(Yii::$app->request->post())) {
            // Устанавливаем пароль
            $model->setPassword($model->password);
            $model->generateAuthKey();

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Пользователь успешно зарегистрирован');
                return $this->redirect(['admin/users']);
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionClearCache()
    {
        Yii::$app->cache->flush();

        foreach (glob(Yii::getAlias('@webroot/assets/*')) as $assetDir) {
            if (is_dir($assetDir)) {
                Yii::removeDirectory($assetDir);
            }
        }

        Yii::removeDirectory(Yii::getAlias('@runtime/cache'));

        Yii::$app->session->setFlash('success', 'Кеш успешно очищен');
        return $this->redirect(Yii::$app->request->referrer ?: ['site/index']);
    }
}
