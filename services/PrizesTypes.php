<?php


namespace app\services;

use app\models\enums\PrizesKinds;
use Exception;

class PrizesTypes
{
    const KIND_MONEY = 1;
    const KIND_LOYALTY = 2;
    const KIND_BOX = 3;

    /**
     * @return AbstractPrizeType|null
     * @throws Exception
     */
    public function randomizeKind(): ?AbstractPrizeType
    {
        $kind = random_int(1, 3);
        $kindClass = null;
        switch ($kind) {
            case self::KIND_MONEY:
                $kindClass = new MoneyPrize();
                break;
            case self::KIND_LOYALTY:
                $kindClass = new LoyaltyPrize();
                break;
            case self::KIND_BOX:
                $kindClass = new BoxPrize();
                break;
            default:
                break;
        }
        return $kindClass;
    }
}