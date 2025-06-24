<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>
<section class="maysection margin-top2">


<div class="container">
    <div class="ww2card row">
        <div class="card-header container">
            <h2 class="card-title">

                <?= Html::encode($this->title) ?>
            </h2>
        </div>

        <div class="">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            <?= $form->field($model, 'title')->textInput([
                'maxlength' => true,
                'placeholder' => 'Введите заголовок статьи',
                'class' => 'form-control form-control-lg'
            ]) ?>

            <?= $form->field($model, 'content')->textarea([
                'rows' => 10,
                'placeholder' => 'Напишите содержание статьи...',
                'class' => 'ww2textarea'
            ]) ?>

            <?= $form->field($model, 'author_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>

            <?= $form->field($model, 'imageFile')->fileInput() ?>

            <?php if ($model->image): ?>
                <div class="mb-3">
                    <label>Текущее изображение:</label>
                    <div>
                        <img src="/uploads/<?= $model->image ?>" alt="Изображение статьи" style="max-width: 200px;">
                        <?= Html::a('Удалить', ['delete-image', 'id' => $model->id], [
                            'class' => 'btn btn-sm btn-danger',
                            'data' => [
                                'confirm' => 'Удалить изображение?',
                                'method' => 'post',
                            ]
                        ]) ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="form-group mt-4">
                <div class="d-flex justify-content-between">
                    <?= Html::a('<i class="bi bi-arrow-left"></i> Отмена',
                        $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id],
                        ['class' => 'btn btn-outline-secondary']) ?>

                    <?= Html::submitButton('<i class="bi bi-save"></i> ' .
                        ($model->isNewRecord ? 'Создать статью' : 'Сохранить изменения'),
                        ['class' => 'btn btn-primary button-size']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
        </section>


