<?php
namespace app\models\enums;

use yii2mod\enum\helpers\BaseEnum;

class PrizesKinds extends BaseEnum
{
    public const MONEY = 'money';
    public const LOYALTY = 'loyalty';
    public const BOX = 'box';
}