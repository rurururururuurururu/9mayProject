<section class="maysection margin-top">
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = $article->title;
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//$this->registerCssFile("@web/css/styles.css");
?>

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()): ?>
            <div class="btn-group">
                <?= Html::a('<i class="bi bi-pencil"></i> Редактировать',
                    ['update', 'id' => $article->id],
                    ['class' => 'btn btn-sm btn-outline-primary']) ?>

                <?= Html::a('<i class="bi bi-trash"></i> Удалить',
                    ['delete', 'id' => $article->id],
                    [
                        'class' => 'btn btn-sm btn-outline-danger',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите удалить эту статью?',
                            'method' => 'post',
                        ],
                    ]) ?>
            </div>
        <?php endif; ?>
    </div>


    <?php if ($article->image): ?>
        <div class="ww2-view">
            <img src="<?= $article->getImagePath() ?>"
                 alt="<?= Html::encode($article->title) ?>"
                 class="ww2-image">
        </div>
    <?php endif; ?>


    <div class="card mb-4">
        <div class="card-body">
            <div class="article-content">
                <?= nl2br(Html::encode($article->content)) ?>
            </div>
        </div>
        <div class="card-footer">
            <small class="text-muted">
                <i class="bi bi-calendar"></i> Опубликовано:
                <?= Yii::$app->formatter->asDate($article->created_at) ?>
            </small>
            <?php if (!Yii::$app->user->isGuest): ?>
                <div class="text-center mb-4">
                    <?= Html::a(
                        '<i class="bi bi-file-earmark-pdf"></i> Скачать PDF',
                        ['download-pdf', 'id' => $article->id],
                        ['class' => 'btn btn-primary button-size']
                    ) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>



    <div class="comments-section">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="section-title">
                <i class="bi bi-chat-dots"></i> Комментарии
                <span class="badge bg-secondary"><?= count($comments) ?></span>
            </h3>
        </div>

        <?php if (!Yii::$app->user->isGuest): ?>
            <div class=" ww2card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Добавить комментарий</h5>
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($newComment, 'content')
                        ->textarea([
                            'rows' => 4,
                            'placeholder' => 'Напишите ваш комментарий...',
                            'class' => 'form-control'
                        ])
                        ->label(false) ?>

                    <div class="form-group mt-3">
                        <?= Html::submitButton('Отправить комментарий',
                            ['class' => 'btn btn-primary w-100 button-size']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                <p class="mb-0">
                    <i class="bi bi-info-circle"></i> Чтобы оставить комментарий, пожалуйста
                    <a href="<?= Url::to(['site/login']) ?>">войдите</a> или
                    <a href="<?= Url::to(['site/signup']) ?>">зарегистрируйтесь</a>.
                </p>
            </div>
        <?php endif; ?>

        <div class="comments-list">
            <?php if (empty($comments)): ?>
                <div class="alert  text-center">
                    <i class="bi bi-chat-square-text"></i> Пока нет комментариев. Будьте первым!
                </div>
            <?php else: ?>
                <?php foreach ($comments as $comment): ?>
                    <div class=" card mb-3">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-circle">
                                        <?= mb_substr($comment->user->username, 0, 1) ?>
                                    </div>
                                </div>

                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between mb-2">
                                        <div>
                                            <strong><?= Html::encode($comment->user->username) ?></strong>
                                            <span class="text-muted ms-2">
                                                <i class="bi bi-clock"></i>
                                                <?= Yii::$app->formatter->asRelativeTime($comment->created_at) ?>
                                            </span>
                                        </div>

                                        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()): ?>
                                            <?= Html::a('<i class="bi bi-trash"></i>',
                                                ['/admin/delete-comment', 'id' => $comment->id],
                                                [
                                                    'class' => 'text-danger',
                                                    'title' => 'Удалить комментарий',
                                                    'data' => [
                                                        'confirm' => 'Удалить этот комментарий?',
                                                        'method' => 'post',
                                                    ],
                                                ]) ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="comment-content">
                                        <?= nl2br(Html::encode($comment->content)) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

</section>