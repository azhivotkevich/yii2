<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "weekly_schedule".
 *
 * @property int $id
 * @property int $cabinet_id
 * @property int $user_id
 * @property int $day
 * @property string $time_from
 * @property string $time_to
 * @property string|null $status
 *
 * @property Cabinet $cabinet
 * @property User $user
 */
class WeeklySchedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'weekly_schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cabinet_id', 'user_id', 'day', 'time_from', 'time_to'], 'required'],
            [['cabinet_id', 'user_id', 'day'], 'integer'],
            [['time_from', 'time_to'], 'safe'],
            [['status'], 'string'],
            [['cabinet_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cabinet::class, 'targetAttribute' => ['cabinet_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cabinet_id' => Yii::t('app', 'Cabinet ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'day' => Yii::t('app', 'Day'),
            'time_from' => Yii::t('app', 'Time From'),
            'time_to' => Yii::t('app', 'Time To'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * Gets query for [[Cabinet]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCabinet()
    {
        return $this->hasOne(Cabinet::class, ['id' => 'cabinet_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
