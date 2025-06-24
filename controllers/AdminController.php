<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\User;
use app\models\Article;
use app\models\Comment;

class AdminController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin();
                        }
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    // Управление пользователями
    public function actionUsers()
    {
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => User::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ],
        ]);

        return $this->render('users', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDeleteUser($id)
    {
        $user = User::findOne($id);

        if ($user) {
            // Запрещаем удаление себя и других админов
            if ($user->id == Yii::$app->user->id) {
                Yii::$app->session->setFlash('error', 'Вы не можете удалить самого себя');
            } elseif ($user->is_admin) {
                Yii::$app->session->setFlash('error', 'Нельзя удалить администратора');
            } else {
                $user->delete();
                Yii::$app->session->setFlash('success', 'Пользователь удален');
            }
        }

        return $this->redirect(['users']);
    }

    // Управление статьями
    public function actionArticles()
    {
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => Article::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_DESC]
            ],
        ]);

        return $this->render('articles', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDeleteArticle($id)
    {
        $article = Article::findOne($id);

        if ($article) {
            $article->delete();
            Yii::$app->session->setFlash('success', 'Статья удалена');
        }

        return $this->redirect(['articles']);
    }

    // Управление комментариями
    public function actionComments()
    {
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => Comment::find()->with('article', 'user'),
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_DESC]
            ],
        ]);

        return $this->render('comments', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDeleteComment($id)
    {
        $comment = Comment::findOne($id);

        if ($comment) {
            $comment->delete();
            Yii::$app->session->setFlash('success', 'Комментарий удален');
        }

        return $this->redirect(['comments']);
    }
}