<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>
<section class="maysection margin-top">

<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()): ?>
        <p>
            <?= Html::a('Добавить статью', ['create'], ['class' => 'btn btn-sm btn-document']) ?>

        </p>
    <?php endif; ?>

    <!-- Блок поиска -->
    <div class="ww2card mb-4">
        <div class="card-body">
            <?php echo $this->render('_search', ['model' => $searchModel], ['class' => 'ww2field']); ?>
        </div>
    </div>

    <?php Pjax::begin(['id' => 'article-list']); ?>

    <?php if ($dataProvider->getTotalCount() > 0): ?>
        <div class="alert ww2card">
            Найдено <?= $dataProvider->getTotalCount() ?> статей
        </div>
    <?php endif; ?>


    <div class="row">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_article_item',
            'layout' => "{items}\n{pager}",
            'options' => ['class' => 'list-view'],
            'itemOptions' => ['class' => ''],
            'emptyText' => '<div class="col-12"><div class="ww2card"><div class="card-body text-center py-5"><i class="bi bi-search display-1 text-muted mb-4"></i><h2 class="mb-3">Статьи не найдены</h2><p class="lead text-muted mb-4">Попробуйте изменить условия поиска</p></div></div></div>',
        ]) ?>
    </div>

    <?php Pjax::end(); ?>
</div>
