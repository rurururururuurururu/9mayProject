<section class="maysection margin-top">

<?php use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(); ?>
    <div class="container wdth">
<div class="ww2card wdth">
<?= $form->field($model, 'username')->textInput() ?>
<?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Регистрация', ['class' => 'btn login-button']) ?>
    </div>
</div>
    </div>
<?php ActiveForm::end(); ?>
</section>
