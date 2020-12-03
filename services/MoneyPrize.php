<?php


namespace app\services;


use app\models\enums\PrizesKinds;
use app\models\Prizes;
use Exception;

class MoneyPrize extends AbstractPrizeType
{
    const LIMIT = 1000000;
    const LOYALTY_K = 0.001;

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
        return random_int(0, self::LIMIT);
    }

    public function convertToMoney(Prizes $prize)
    {
        $prize->kind = PrizesKinds::LOYALTY;
        $prize->value *= self::LOYALTY_K;
        $prize->save();
    }
}