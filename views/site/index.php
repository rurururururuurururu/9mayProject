<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $latestArticles app\models\Article[] */
/* @var $searchQuery string */

$this->title = 'Исторический архив Великой Отечественной войны';
?>
<div class="banner">



    <div class="rnd">

        <div class="jumbotron text-center bg-transparent mt-5 mb-5">
            <h1 class="display-4">Победоносный день - 9 мая</h1>

            <p class="lead">Здесь вы можете подробнее узнать о празднике, посвящённом 9 маю</p>

            <!--        <a class="home-link" href="article/index"><button class="article-button">Посмотреть</button>-->
        </div>


    </div>
</div>

<section class="maysection">


    <!-- Герой-баннер -->
    <div class="hero-banner text-center py-5 mb-5">
        <div class="container">
            <h1 class="display-4"><?= Html::encode($this->title) ?></h1>
            <p class="lead mb-4">
                Сохраняем память о героях и событиях самой кровопролитной войны в истории человечества
            </p>

            <!-- Поиск по статьям -->
            <form action="<?= Url::to(['site/index']) ?>" method="get" class="mt-4 mx-auto" style="max-width: 600px;">
                <div class="input-group">
                    <input type="text" name="q" class="form-control form-control-lg"
                           placeholder="Поиск по статьям..." aria-label="Поиск"
                           value="<?= Html::encode($searchQuery) ?>">
                    <button class="btn btn-primary btn-lg" type="submit">
                        <i class="bi bi-search"></i> Найти
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Результаты поиска или последние статьи -->
    <div class="container">
        <?php if (!empty($searchQuery)): ?>
            <div class="row mb-5">
                <div class="col-12 mb-4">
                    <h2 class="section-title">
                        <i class="bi bi-search"></i> Результаты поиска: "<?= Html::encode($searchQuery) ?>"
                    </h2>
                </div>

                <?php if (empty($latestArticles)): ?>
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-body text-center py-5">
                                <i class="bi bi-search display-1 text-muted mb-4"></i>
                                <h2 class="mb-3">Ничего не найдено</h2>
                                <p class="lead text-muted mb-4">
                                    Попробуйте изменить поисковый запрос
                                </p>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($latestArticles as $article): ?>
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <?= Html::a(
                                            Html::encode($article->title),
                                            ['article/view', 'id' => $article->id],
                                            ['class' => 'text-decoration-none']
                                        ) ?>
                                    </h3>
                                    <div class="card-text mb-3 text-truncate" style="height: 220px; overflow: hidden;">
                                        <?= nl2br(Html::encode(mb_substr($article->content, 0, 200))) ?>...
                                    </div>
                                </div>
                                <div class="card-footer bg-white">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="bi bi-calendar"></i>
                                            <?= Yii::$app->formatter->asDate($article->created_at) ?>
                                        </small>
                                        <?= Html::a('Читать', ['article/view', 'id' => $article->id],
                                            ['class' => 'btn btn-sm btn-outline-primary']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <!-- Последние статьи -->
            <div class="row mb-5">
                <div class="col-12 mb-4">
                    <h2 class="section-title">
                        <i class="bi bi-newspaper"></i> Последние публикации
                    </h2>
                    <p class="text-muted">Самые свежие материалы из нашего архива</p>
                </div>

                <?php foreach ($latestArticles as $article): ?>
                    <div class="col-4 mb-4">
                        <div class="card h-200">
                            <div class="card-body card-height-v3">
                                <h3 class="card-title overflow-hidden ">
                                    <?= Html::a(
                                        Html::encode($article->title),
                                        ['article/view', 'id' => $article->id],
                                        ['class' => 'text-decoration-none ww2links']
                                    ) ?>
                                </h3>
                                <div class="ww2text mb-3 text-truncate" style="height: 120px; overflow: hidden;">
                                    <?= nl2br(Html::encode(mb_substr($article->content, 0, 200))) ?>...
                                </div>
                            </div>
                            <div class="card-footer bg-gray">

                                    <small class="text-muted">
                                        <i class="bi bi-calendar"></i>
                                        <?= Yii::$app->formatter->asDate($article->created_at) ?>
                                    </small>
                                    <?= Html::a('Читать', ['article/view', 'id' => $article->id], [
                                        'class' => 'btn btn-sm btn-document ',
                                        'style' => 'position: relative;'
                                    ]) ?>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="col-12 text-center mt-4">
                    <?= Html::a('Все статьи', ['article/index'],
                        ['class' => 'btn btn-outline-secondary']) ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- О проекте -->

        <div class="container">
            <div class="ww2">
                    <div class="ww2-images">
                            <img src="<?= Yii::getAlias('@web/imgs/ww2.png') ?>"
                                 alt="Исторический архив Великой Отечественной войны"
                                 class="img-fluid ww2-image">
                    </div>

                <div class="ww2-about">
                    <h2 class="mb-4 section-title">О нашем проекте</h2>
                    <p class="lead">
                        Мы создаем крупнейший цифровой архив материалов о Великой Отечественной войне,
                        чтобы сохранить память о героизме и трагедии тех лет для будущих поколений.
                    </p>
                    <p>
                        Наш проект объединяет людей со всего пост-советского пространства, которые хотят
                        сохранить правду о событиях 1941-1945 годов. Каждая статья, каждый документ,
                        каждая фотография - это кирпичик в стене памяти о великом подвиге наших  народов.
                    </p>
                    <div class="mt-4">
                        <?= Html::a('Узнать больше', ['site/about'],
                            ['class' => 'btn btn-outline-secondary ']) ?>
                    </div>
                </div>

            </div>
        </div>
</section>