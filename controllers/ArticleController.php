<?php

namespace app\controllers;

use Mpdf\Mpdf;
use Yii;
use app\models\Article;
use app\models\ArticleSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\web\UploadedFile;

class ArticleController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update', 'delete'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            // Только администраторы
                            return Yii::$app->user->identity->isAdmin();
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSearch()
    {
        $q = Yii::$app->request->get('q');

        $query = Article::find();

        if (!empty($q)) {
            $words = explode(' ', $q);
            $conditions = ['or'];

            foreach ($words as $word) {
                if (strlen($word) > 2) {
                    $conditions[] = ['like', 'title', $word];
                    $conditions[] = ['like', 'content', $word];
                }
            }

            $query->andWhere($conditions);
        }

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('search', [
            'dataProvider' => $dataProvider,
            'searchQuery' => $q
        ]);
    }

    public function actionView($id)
    {
        $article = $this->findModel($id);
        $newComment = new \app\models\Comment();
        $comments = $article->comments;

        if ($newComment->load(Yii::$app->request->post())) {
            if (Yii::$app->user->isGuest) {
                Yii::$app->session->setFlash('error', 'Чтобы оставить комментарий, войдите или зарегистрируйтесь');
                return $this->redirect(['site/login']);
            }

            $newComment->article_id = $id;
            $newComment->user_id = Yii::$app->user->id;
            $newComment->created_at = new \yii\db\Expression('NOW()');

            if ($newComment->save()) {
                Yii::$app->session->setFlash('success', 'Комментарий добавлен');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка при сохранении комментария');
            }
        }

        return $this->render('view', [
            'article' => $article,
            'newComment' => $newComment,
            'comments' => $comments
        ]);
    }

    public function actionCreate()
    {
        $model = new Article();

        if ($model->load(Yii::$app->request->post())) {
            $model->author_id = Yii::$app->user->id;
            if ($model->save()) {
                Yii::info("Модель сохранена, ID: {$model->id}", 'app');

                if ($model->saveImage()) {
                    Yii::info("Изображение сохранено: {$model->image}", 'app');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::error("Ошибка сохранения изображения", 'app');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                if ($model->saveImage()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка сохранения изображения');
                }
            }
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionDeleteImage($id)
    {
        $model = $this->findModel($id);

        if ($model->image && file_exists('uploads/articles/' . $model->image)) {
            unlink('uploads/articles/' . $model->image);
        }

        $model->image = null;
        $model->save();

        return $this->redirect(['update', 'id' => $id]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', 'Статья успешно удалена');
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрошенная статья не найдена');
    }

    public function actionDownloadPdf($id)
    {
        $article = Article::findOne($id);
        if (!$article) {
            throw new NotFoundHttpException('Статья не найдена');
        }

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'dejavusans' // Поддержка русского языка
        ]);

        $html = $this->renderPartial('_pdf_template', [
            'article' => $article
        ]);

        $mpdf->WriteHTML($html);

        Yii::$app->response->format = Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'application/pdf');
        Yii::$app->response->headers->add('Content-Disposition', 'attachment; filename="'.$article->title.'.pdf"');

        return $mpdf->Output('', 'S');
    }
}