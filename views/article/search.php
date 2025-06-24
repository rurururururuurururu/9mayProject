<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchQuery string */

$this->title = 'Результаты поиска: ' . Html::encode($searchQuery);
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-search">
    <div class="container py-5">
        <h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

        <?php if (!empty($searchQuery)): ?>
            <?php if ($dataProvider->getTotalCount() > 0): ?>
                <div class="alert alert-light mb-4">
                    Найдено <?= $dataProvider->getTotalCount() ?> статей
                </div>

                <div class="row">
                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemView' => '_article_item',
                        'layout' => "{items}\n{pager}",
                        'itemOptions' => ['class' => 'col-lg-6 mb-4'],
                    ]) ?>
                </div>
            <?php else: ?>
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-search display-1 text-muted mb-4"></i>
                        <h2 class="mb-3">Ничего не найдено</h2>
                        <p class="lead text-muted mb-4">
                            Попробуйте изменить поисковый запрос или просмотрите все статьи
                        </p>
                        <?= Html::a('Все статьи', ['index'], ['class' => 'btn btn-primary btn-lg']) ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="card shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="bi bi-exclamation-circle display-1 text-muted mb-4"></i>
                    <h2 class="mb-3">Введите поисковый запрос</h2>
                    <p class="lead text-muted mb-4">
                        Пожалуйста, введите слова для поиска в форме выше
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>