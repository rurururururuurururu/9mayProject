<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model app\models\Article */
?>


<div class="ww2card h-100 ">
    <div class="card-body card-height-v3">
        <h2 class="card-title">
            <?= Html::a(
                Html::encode($model->title),
                ['view', 'id' => $model->id],
                ['class' => 'text-decoration-none ww2links']
            ) ?>
        </h2>
        <div class="card-text mb-3">
            <?= nl2br(Html::encode(mb_substr($model->content, 0, 200))) ?>...
        </div>
    </div>
    <div class="card-footer bg-gray">

            <small class="text-muted">
                <i class="bi bi-calendar"></i>
                <?= Yii::$app->formatter->asDate($model->created_at) ?>
            </small>
            <?= Html::a('Читать', ['view', 'id' => $model->id],
                ['class' => 'btn btn-sm  ']) ?>

    </div>
</div>

