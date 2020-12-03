<?php


namespace app\services;


use app\models\Prizes;
use app\models\User;

abstract class AbstractPrizeType
{
    const LIMIT = -1; // limit of prizes count. -1 = unlimited

    abstract public function getPrizeKind(): string;
    abstract public function randomizePrize(): int;

    public function connectToUser(Prizes $prize, User $user): bool
    {
        $prize->user_id = $user->getId();
        return $prize->save();
    }

    public function getPrize(Prizes $prize): bool
    {
        return $prize->setStatus(Prizes::STATUS_APPROVED);
    }

    public function rejectPrize(Prizes $prize): bool
    {
        return $prize->setStatus(Prizes::STATUS_REJECTED);
    }

    public function sendPrize(Prizes $prize): bool
    {
        return $prize->setStatus(Prizes::STATUS_SENT);
    }
}