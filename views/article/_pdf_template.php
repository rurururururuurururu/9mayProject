<?php
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= Html::encode($article->title) ?></title>
    <style>
        body { font-family: DejaVuSans, sans-serif; }
        h1 { color: #0066cc; border-bottom: 1px solid #ccc; }
        .content { line-height: 1.6; }
        .footer { margin-top: 50px; text-align: center; font-size: 0.8em; color: #666; }
    </style>
</head>
<body>
<h1><?= Html::encode($article->title) ?></h1>

<?php if ($article->image): ?>
    <div style="text-align: center; margin: 20px 0;">
        <img src="<?= Yii::getAlias('@webroot/uploads/articles/'.$article->image) ?>"
             style="max-width: 500px; max-height: 300px;">
    </div>
<?php endif; ?>

<div class="content">
    <?= nl2br(Html::encode($article->content)) ?>
</div>

<div class="footer">
    Сгенерировано <?= date('d.m.Y H:i') ?> | <?= Yii::$app->name ?>
</div>
</body>
</html>