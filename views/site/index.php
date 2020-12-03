<?php

/* @var $this yii\web\View */

$this->title = 'Get Prize Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <?php if(Yii::$app->user->isGuest): ?>
            <h1>Hello, Guest!</h1>
            <p class="lead">Please, login to get a prize.</p>

            <p><a class="btn btn-lg btn-success" href="/site/login">Login</a></p>
        <?php else: ?>
            <h1>Hello, <?=Yii::$app->user->identity->username?>!</h1>
            <p><a class="btn btn-lg btn-success" href="/site/get-prize">Get Prize</a></p>
        <?php endif; ?>
    </div>

</div>
