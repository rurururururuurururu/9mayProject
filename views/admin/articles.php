<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css');


$this->title = 'Управление статьями';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="maysection margin-top">

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= Html::a('Добавить статью', ['article/create'], ['class' => 'btn btn-primary button-size']) ?>
    </div>


        <div class="table-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'tableOptions' => ['class' => 'table table-hover'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'title',
                    [
                        'attribute' => 'created_at',
                        'format' => ['date', 'php:d.m.Y H:i'],
                        'header' => 'Дата публикации'
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<i class="bi bi-eye"></i>', ['article/view', 'id' => $model->id], [
                                    'title' => 'Просмотреть',
                                    'target' => '_blank'
                                ]);
                            },
                            'update' => function ($url, $model) {
                                return Html::a('<i class="bi bi-pencil"></i>', ['article/update', 'id' => $model->id], [
                                    'title' => 'Редактировать'
                                ]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<i class="bi bi-trash"></i>', ['delete-article', 'id' => $model->id], [
                                    'title' => 'Удалить',
                                    'data' => [
                                        'confirm' => 'Вы уверены, что хотите удалить эту статью?',
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