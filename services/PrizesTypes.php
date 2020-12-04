<?php


namespace app\services;

use app\models\enums\PrizesKinds;
use app\models\Prize;
use Exception;
use Yii;

class PrizesTypes
{
    public const KIND_MONEY = 1;
    public const KIND_LOYALTY = 2;
    public const KIND_BOX = 3;
    public const MAP = [
        PrizesKinds::MONEY => self::KIND_MONEY,
        PrizesKinds::LOYALTY => self::KIND_LOYALTY,
        PrizesKinds::BOX => self::KIND_BOX,
    ];

    /**
     * @return AbstractPrizeType|null
     * @throws Exception
     */
    public function randomizeKind(): ?AbstractPrizeType
    {
        $kind = random_int(1, 3);
        $kindClass = $this->getKind($kind);
        if ($kindClass->isOverLimit()) {
            $kindClass = $this->randomizeKind();
        }
        return $kindClass;
    }

    /**
     * @param string $kindName
     * @return AbstractPrizeType|null
     */
    public function getKindByName(string $kindName): ?AbstractPrizeType
    {
        return $this->getKind(self::MAP[$kindName]);
    }

    public function getKind(int $kind): ?AbstractPrizeType
    {
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