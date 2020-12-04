<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prize_boxes".
 *
 * @property int $id
 * @property string $name
 */
class PrizeBoxes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'prize_boxes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return int
     */
    public static function getLength(): int
    {
        return count(self::find()->all());
    }
}
