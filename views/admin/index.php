<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Панель администратора';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="maysection margin-top">

<div class="admin-index">

    <h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card  shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-people display-1 text-primary mb-3"></i>
                    <h3 class="card-title">Пользователи</h3>
                    <p class="card-text">Управление зарегистрированными пользователями сайта</p>
                    <?= Html::a('Перейти', ['users'], ['class' => 'btn btn-primary mt-2 button-size']) ?>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-file-text display-1 text-success mb-3"></i>
                    <h3 class="card-title">Статьи</h3>
                    <p class="card-text">Управление статьями и публикациями на сайте</p>
                    <?= Html::a('Перейти', ['articles'], ['class' => 'btn btn-primary mt-2 button-size' ]) ?>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card  shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-chat-dots display-1 text-info mb-3"></i>
                    <h3 class="card-title">Комментарии</h3>
                    <p class="card-text">Управление комментариями к статьям</p>
                    <?= Html::a('Перейти', ['comments'], ['class' => 'btn btn-primary mt-2 button-size']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
</section>