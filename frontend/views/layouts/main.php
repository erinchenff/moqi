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
        <style>
            body {
                padding-top: 60px;
            }
            #footer {
                padding-top: 2em;
            }
        </style>
    </head>
    <body>
        <div id="nav-main" class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-main-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="#">默契</a>
                </div>

                <div class="collapse navbar-collapse" id="nav-main-collapse">
                    <ul class="nav navbar-nav">
                    </ul>

                    <p id="me" class="navbar-text navbar-right"><a href="/auth/login">去登录</a></p>
                </div>
            </div>
        </div>

        <p id="me"></p>
        <?php $this->beginBody(); ?>

        <?= $content; ?>

        <p id="footer" class="text-center">
            <?php echo date('Y'); ?><br>
        </p>

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
