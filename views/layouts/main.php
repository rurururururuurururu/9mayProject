<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header id="header">
        <?php
        NavBar::begin([
            'brandLabel' => 'Победоносец',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-expand-lg fixed-top',
                'id' => 'mainNavbar'
            ],
            'innerContainerOptions' => ['class' => 'container-fluid'],
        ]);

        $menuItems = [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'Все статьи', 'url' => ['/article/index']],
            ['label' => 'О проекте', 'url' => ['/map/index']],
        ];

        if (!Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Написать статью', 'url' => ['/article/create']];
        }

        if (!Yii::$app->user->isGuest && method_exists(Yii::$app->user->identity, 'isAdmin') && Yii::$app->user->identity->isAdmin()) {
            $menuItems[] = ['label' => 'Админка', 'url' => ['/admin/index'], 'options' => ['class' => 'admin-menu-item']];
        }

//        $menuItems[] = ['label' => 'Карта войны', 'url' => ['/map/index']];

        $rightItem = Yii::$app->user->isGuest
            ? ['label' => 'Войти', 'url' => ['/site/login'], 'linkOptions' => ['class' => 'nav-link']]
            : '<li class="nav-item">'
            . Html::beginForm(['/site/logout'])
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn nav-link logout']
            )
            . Html::endForm()
            . '</li>';

        echo '<div class="d-flex flex-grow-1 justify-content-center">';
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav'],
            'items' => $menuItems,
        ]);
        echo '</div>';

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ms-auto'],
            'items' => [$rightItem],
            'encodeLabels' => false,
        ]);

        NavBar::end();
        ?>
    </header>
    <main id="main" class="flex-shrink-0" role="main">
        <div class="container1">

            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

<!--    <footer id="footer" class="mt-auto footer">-->
<!--        <div class="container">-->
<!--            <div class="row">-->
<!--                <div class="col-md-6 text-center text-md-start">-->
<!--                    <h5>Память и уважение</h5>-->
<!--                    <p>Архив материалов о Великой Отечественной войне</p>-->
<!--                </div>-->
<!--                <div class="col-md-6 text-center text-md-end">-->
<!--                    <p>-->
<!--                        <i class="bi bi-envelope"></i> info@voinajournal.ru<br>-->
<!--                        <i class="bi bi-telephone"></i> +7 495 123-45-67-->
<!--                    </p>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="text-center mt-3">-->
<!--                <small>&copy; --><?php //= date('Y') ?><!-- Исторический архив. Все права защищены.</small>-->
<!--            </div>-->
<!--        </div>-->
<!--    </footer>-->

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>