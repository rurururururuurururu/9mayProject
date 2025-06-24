<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model app\models\ArticleSearch */
?>

<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    'options' => [
        'data-pjax' => 1,
        'class' => 'search-form'
    ],
]); ?>

    <div class="input-group">
        <?= $form->field($model, 'globalSearch', [
            'options' => ['class' => 'form-group flex-grow-1 mb-0'],
            'inputOptions' => [
                'class' => 'form-control form-control-lg',
                'placeholder' => 'Поиск по заголовку и содержанию...'
            ],
            'template' => '{input}',
        ])->textInput() ?>

        <div class="input-group-append">
            <?= Html::submitButton('<i class="bi bi-search"></i> Найти', [
                'class' => 'btn btn-primary btn-lg'
            ]) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>