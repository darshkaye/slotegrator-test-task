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
    public static function tableName()
    {
        return 'prize_boxes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public static function getLength()
    {
        return count(self::find()->all());
    }
}
