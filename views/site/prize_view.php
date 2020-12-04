<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $prize app\models\Prize */
/* @var $prizeKind app\services\AbstractPrizeType */

use yii\helpers\Html;
use app\models\enums\PrizesKinds;

$this->title = 'Prize';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>



        <div class="alert alert-success">
            Thank you for participating.
        </div>

        <p>
            You've won <?=$prize->kind?>: <?=$prizeKind->getValue($prize)?><br>
            You can do following:
            <ul>
                <li><a href="/site/approve-prize?id=<?=$prize->id?>">Get</a></li>
                <li><a href="/site/reject-prize?id=<?=$prize->id?>">Reject</a></li>
                <?php if ($prize->kind === PrizesKinds::MONEY):?>
                <li><a href="/site/money-to-loyalty?id=<?=$prize->id?>">Convert</a></li>
                <?php endif; ?>
            </ul>
        </p>


</div>
