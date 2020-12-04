<?php


namespace app\services;


use app\models\enums\PrizesKinds;
use app\models\Prize;
use Exception;

class MoneyPrize extends AbstractPrizeType
{
    public const LIMIT = 1000000;
    public const LOYALTY_K = 0.001;

    public function getPrizeKind(): string
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
    public function convertToMoney(Prize $prize): bool
    {
        $prize->kind = PrizesKinds::LOYALTY;
        $prize->value *= self::LOYALTY_K;
        $prize->status = Prize::STATUS_CONVERTED;
        return $prize->save();
    }
}