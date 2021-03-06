<?php


namespace app\services;

use app\models\enums\PrizesKinds;
use app\models\Prize;
use app\models\PrizeBoxes;
use yii\base\ErrorException;
use Exception;
use Yii;

class BoxPrize extends AbstractPrizeType
{
    public const LIMIT = 20;
    /**
     * @return string
     */
    public static function getPrizeKind(): string
    {
        return PrizesKinds::BOX;
    }
    /**
     * @return int
     * @throws Exception
     */
    public function randomizePrize(): int
    {
        $boxesCount = PrizeBoxes::getLength();
        if ($boxesCount === 0) {
            throwException(new ErrorException('Boxes are absent'));
        }
        return random_int(1, $boxesCount);
    }

    /**
     * @param Prize $prize
     * @return string
     */
    public function getValue(Prize $prize): string
    {
        return PrizeBoxes::findOne(['id' => $prize->value])->name;
    }

    /**
     * @return bool
     */
    public function isOverLimit():bool
    {
        $prizes = Prize::findAll([
            'user_id' => Yii::$app->user->getId(),
            'kind' => self::getPrizeKind(),
        ]);
        return self::LIMIT <= count($prizes);
    }
}