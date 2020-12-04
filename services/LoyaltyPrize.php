<?php


namespace app\services;

use app\models\enums\PrizesKinds;
use Exception;

class LoyaltyPrize extends AbstractPrizeType
{
    const MAX_VALUE = 1000;

    public function getPrizeKind(): string
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
}