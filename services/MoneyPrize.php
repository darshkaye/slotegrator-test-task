<?php


namespace app\services;


use app\models\enums\PrizesKinds;
use app\models\Prize;
use app\models\User;
use Exception;
use Yii;
use yii\httpclient\Client;

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

    public function sendPrize(Prize $prize): bool
    {
        //sent API-request to bank with money
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl('https://reqbin.com/echo/post/json')
            ->setData([
                "Id" => 78912,
                "Customer" => "Jason Sweet",
                "Quantity" => 1,
                "Price" => 18
            ])
            ->send();
        if ($response->isOk) {
            return parent::sendPrize($prize);
        }
        return false;
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
        $count = array_sum(array_map(fn(Prize $prize) => $prize->value, $prizes));
        return self::LIMIT <= $count;
    }
}