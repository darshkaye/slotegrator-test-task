<?php


namespace app\services;

use app\models\enums\PrizesKinds;
use app\models\Prize;
use app\models\User;
use Exception;
use Yii;

class LoyaltyPrize extends AbstractPrizeType
{
    public const MAX_VALUE = 1000;

    /**
     * @return string
     */
    public static function getPrizeKind(): string
    {
        return PrizesKinds::LOYALTY;
    }

    /**
     * @return int
     * @throws Exception
     */
    public function randomizePrize(): int
    {
        return random_int(1, self::MAX_VALUE);
    }

    /**
     * @param Prize $prize
     * @return bool
     */
    public function approvePrize(Prize $prize): bool
    {
        $user = User::findOne(['id' => Yii::$app->user->getId()]);
        $user->loyalty += $prize->value;
        if ($user->save()) {
            return $prize->setStatus(Prize::STATUS_APPROVED);
        }
        return false;
    }

    /**
     * @param Prize $prize
     * @return bool
     */
    public function sendPrize(Prize $prize): bool
    {
        return false;
    }
}