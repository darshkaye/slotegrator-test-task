<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

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
class Prize extends \yii\db\ActiveRecord
{
    public const STATUS_GENERATED = 'generated';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_SENT = 'sent';
    public const STATUS_CONVERTED = 'converted';

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'prizes';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['user_id', 'kind', 'value'], 'required'],
            [['user_id', 'value', 'created_at', 'updated_at'], 'integer'],
            [['kind', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
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

    public function setData(array $values): bool
    {
        try {
            foreach ($values as $key => $value) {
                $this->{$key} = $value;
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @param string $status
     * @return bool
     */
    public function setStatus(string $status): bool
    {
        $this->status = $status;
        return$this->save();
    }
}
