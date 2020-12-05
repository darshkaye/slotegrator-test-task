<?php

namespace tests\unit\models;

use app\models\enums\PrizesKinds;
use app\models\Prize;
use app\services\MoneyPrize;

class MoneyPrizeTest extends \Codeception\Test\Unit
{
    public function testConvertMoneyToLoyalty()
    {
        $moneyValue = 1000;
        $prize = $this->getMockBuilder(Prize::class)
            ->disableOriginalConstructor()
            ->setMethods(['save', 'attributes'])
            ->getMock();
        $prize->method('save')->willReturn(true);
        $prize->method('attributes')->willReturn([
            'user_id' => 1,
            'kind' => PrizesKinds::MONEY,
            'value' => $moneyValue,
            'status' => Prize::STATUS_GENERATED,
        ]);
        $moneyPrize = new MoneyPrize();
        expect_that($prize = $moneyPrize->convertToMoney($prize));
        expect($prize->value)->equals($moneyValue * $moneyPrize::LOYALTY_K);
    }
}
