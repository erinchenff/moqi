<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>">
    <head>
        <meta charset="<?= Yii::$app->charset; ?>">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags(); ?>
        <title><?= Html::encode($this->title); ?></title>
        <?php $this->head(); ?>
    </head>
    <body>
        <p id="me"><a href="/auth/login">去登录</a></p>
        <?php $this->beginBody(); ?>

        <?= $content; ?>

        <?php $this->endBody(); ?>
        <script>
            $(function() {
                var xhr = $.get('/auth/me');
                xhr.done(function(me) {
                    if (!me.isGuest) {
                        $('#me').html(me.info.realName + '，你好 <a href="/auth/logout">退出</a>');
                    }
                });
            })
        </script>
    </body>
</html>
<?php $this->endPage(); ?>
