<?php

namespace app\commands;

use app\models\enums\PrizesKinds;
use app\models\Prize;
use app\services\MoneyPrize;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command sent money to users
 *
 * This command works by blocks
 *
 */
class SendMoneyController extends Controller
{
    /**
     * This command sent money to users
     * @param int $size
     * @return int
     */
    public function actionIndex($size = 10): int
    {
        if (filter_var($size, FILTER_VALIDATE_INT) === false) {
            echo "Size of block can be on;y integer\n";
            return ExitCode::DATAERR;
        }

        $prizes = Prize::find()->where([
            'kind' => PrizesKinds::MONEY,
            'status' => Prize::STATUS_APPROVED,
        ])->limit($size)->all();

        $moneyPrize = new MoneyPrize();
        $sentCount = 0;
        foreach ($prizes as $prize) {
            $sentCount += $moneyPrize->sendPrize($prize);
        }
        echo "{$sentCount} money prizes were sent\n";

        return ExitCode::OK;
    }
}
