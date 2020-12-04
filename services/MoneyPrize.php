<?php


namespace app\services;


use app\models\enums\PrizesKinds;
use app\models\Prize;
use app\models\User;
use Exception;
use Yii;

class MoneyPrize extends AbstractPrizeType
{
    public const LIMIT = 1000000;
    public const LOYALTY_K = 0.001;

    /**
     * @return string
     */
    public static function getPrizeKind(): string
    {
        return PrizesKinds::MONEY;
    }

    /**
     * @return int
     * @throws Exception
     */
    public function randomizePrize(): int
    {
        return random_int(1, self::LIMIT);
    }

    /**
     * @param Prize $prize
     * @return bool
     */
    public function approvePrize(Prize $prize): bool
    {
        $user = User::findOne(['id' => Yii::$app->user->getId()]);
        $user->money += $prize->value;
        if ($user->save()) {
            return $prize->setStatus(Prize::STATUS_APPROVED);
        }
        return false;
    }

    /**
     * @param Prize $prize
     * @return bool
     */
    public function convertToMoney(Prize $prize): bool
    {
        $prize->kind = LoyaltyPrize::getPrizeKind();
        $prize->value = floor($prize->value * self::LOYALTY_K);
        $prize->status = Prize::STATUS_CONVERTED;
        $user = User::findOne(['id' => Yii::$app->user->getId()]);
        $user->loyalty += $prize->value;
        if ($user->save()) {
            return $prize->save();
        }
        return false;
    }
}