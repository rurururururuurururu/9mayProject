<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model app\models\Article */
?>
<div class="card h-100">
    <div class="card-body">
        <h3 class="card-title">
            <?= Html::a(
                Html::encode($model->title),
                ['view', 'id' => $model->id],
                ['class' => 'text-decoration-none']
            ) ?>
        </h3>
        <div class="card-text mb-2">
            <?= nl2br(Html::encode(mb_substr($model->content, 0, 150))) ?>...
        </div>
    </div>
    <div class="card-footer bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted">
                <i class="bi bi-calendar"></i>
                <?= Yii::$app->formatter->asDate($model->created_at) ?>
            </small>
            <?= Html::a('Читать', ['view', 'id' => $model->id],
                ['class' => 'btn btn-sm btn-outline-primary']) ?>
        </div>
    </div>
</div>