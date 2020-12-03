<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prizes".
 *
 * @property int $id
 * @property int $user_id
 * @property string $kind
 * @property int $value
 * @property string $status
 * @property int $created_at
 * @property int $updated_at
 */
class Prizes extends \yii\db\ActiveRecord
{
    const STATUS_GENERATED = 'generated';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';
    const STATUS_SENT = 'sent';
    const STATUS_CONVERTED = 'converted';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prizes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'kind', 'value', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'value', 'created_at', 'updated_at'], 'integer'],
            [['kind', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'kind' => 'Kind',
            'value' => 'Value',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function setStatus(string $status): bool
    {
        $this->status = $status;
        return$this->save();
    }
}
