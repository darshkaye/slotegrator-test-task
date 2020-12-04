<?php


namespace app\services;


use app\models\Prize;
use app\models\PrizeBoxes;
use app\models\User;

abstract class AbstractPrizeType
{
    public const LIMIT = -1; // limit of prizes count. -1 = unlimited

    abstract public static function getPrizeKind(): string;
    abstract public function randomizePrize(): int;

    /**
     * @param Prize $prize
     * @return string
     */
    public function getValue(Prize $prize): string
    {
        return (string)$prize->value;
    }

    public function approvePrize(Prize $prize): bool
    {
        return $prize->setStatus(Prize::STATUS_APPROVED);
    }

    public function rejectPrize(Prize $prize): bool
    {
        return $prize->setStatus(Prize::STATUS_REJECTED);
    }

    public function convertToMoney(Prize $prize): bool
    {
        return false;
    }

    public function sendPrize(Prize $prize): bool
    {
        return $prize->setStatus(Prize::STATUS_SENT);
    }

    public function isOverLimit():bool
    {
        return false;
    }
}