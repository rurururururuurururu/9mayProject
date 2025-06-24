<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css');
$this->title = 'Управление пользователями';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="maysection margin-top">

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= Html::a('Добавить пользователя', ['site/signup'], ['class' => 'btn btn-primary button-size']) ?>
    </div>


        <div class="table-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'tableOptions' => ['class' => 'table  table-hover'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'username',
                    [
                        'attribute' => 'is_admin',
                        'label' => 'Администратор',
                        'value' => function($model) {
                            return $model->is_admin ? 'Да' : 'Нет';
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{delete}',
                        'buttons' => [
                            'delete' => function ($url, $model, $key) {
                                // 1. Отладочная информация
                                $debugInfo = sprintf(
                                    "UserID: %d (Admin: %s), Current: %d (Admin: %s)",
                                    $model->id,
                                    $model->is_admin ? 'Yes' : 'No',
                                    Yii::$app->user->id,
                                    Yii::$app->user->identity->is_admin ? 'Yes' : 'No'
                                );

                                // 2. Проверка условий
                                $isAdmin = !Yii::$app->user->isGuest && Yii::$app->user->identity->is_admin;
                                $isSelf = $model->id == Yii::$app->user->id;
                                $isModelAdmin = $model->is_admin;

                                // 3. Условия отображения
                                if (!$isAdmin) {
                                    return Html::tag('div', 'Только админам', ['class' => 'text-muted']);
                                }

                                if ($isSelf) {
                                    return Html::tag('div', 'Нельзя удалить себя', [
                                        'class' => 'text-danger small',
                                        'title' => $debugInfo
                                    ]);
                                }

                                if ($isModelAdmin) {
                                    return Html::tag('div', 'Нельзя удалить админа', [
                                        'class' => 'text-warning small',
                                        'title' => $debugInfo
                                    ]);
                                }

                                // 4. Возвращаем кнопку с иконкой
                                return Html::a(
                                    '<i class="bi bi-trash"></i> Удалить',
                                    ['delete-user', 'id' => $model->id],
                                    [
                                        'title' => "Удалить пользователя\n" . $debugInfo,
                                        'data' => [
                                            'confirm' => 'Вы уверены, что хотите удалить этого пользователя?',
                                            'method' => 'post',
                                        ],
                                        'class' => 'btn btn-sm btn-danger',
                                        'style' => 'display: inline-block; padding: 5px;'
                                    ]
                                );
                            }
                        ],
                        'contentOptions' => [
                            'style' => 'width: 120px;',
                            'class' => 'text-center'
                        ]
                    ],
                ],
            ]); ?>
        </div>

</div>
</section>