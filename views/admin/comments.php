<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css');


$this->title = 'Управление комментариями';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="maysection margin-top">

<div class="container">

    <h1 class="mb-4"><?= Html::encode($this->title) ?></h1>


        <div class="table-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'tableOptions' => ['class' => 'table table-hover'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    [
                        'attribute' => 'article.title',
                        'label' => 'Статья',
                        'value' => function($model) {
                            return Html::a($model->article->title, ['article/view', 'id' => $model->article_id], [
                                'target' => '_blank'
                            ]);
                        },
                        'format' => 'raw'
                    ],
                    [
                        'attribute' => 'user.username',
                        'label' => 'Автор'
                    ],
                    [
                        'attribute' => 'content',
                        'value' => function($model) {
                            return mb_substr($model->content, 0, 100) . (mb_strlen($model->content) > 100 ? '...' : '');
                        }
                    ],
                    [
                        'attribute' => 'created_at',
                        'format' => ['date', 'php:d.m.Y H:i'],
                        'header' => 'Дата'
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {delete}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<i class="bi bi-eye"></i>', ['article/view', 'id' => $model->article_id, '#' => 'comment-' . $model->id], [
                                    'title' => 'Просмотреть в статье',
                                    'target' => '_blank'
                                ]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<i class="bi bi-trash"></i>', ['delete-comment', 'id' => $model->id], [
                                    'title' => 'Удалить',
                                    'data' => [
                                        'confirm' => 'Вы уверены, что хотите удалить этот комментарий?',
                                        'method' => 'post',
                                    ],
                                ]);
                            }   
                        ]
                    ],
                ],
            ]); ?>
        </div>
    </div>

</section>