<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "daily_schedule".
 *
 * @property int $id
 * @property int $cabinet_id
 * @property int $user_id
 * @property string $date
 * @property string $time_from
 * @property string $time_to
 * @property string|null $status
 *
 * @property Cabinet $cabinet
 * @property User $user
 */
class DailySchedule extends ActiveRecord
{
    public array $dates = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'daily_schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'filter', 'filter' => function() {
                if (Yii::$app->user->can('doctor')) {
                    return Yii::$app->user->id;
                }
                return $this->user_id;
            }],
            [['cabinet_id','user_id', 'date', 'time_from', 'time_to'], 'required'],
            [['cabinet_id', 'user_id'], 'integer'],
            [['date', 'time_from', 'time_to'], 'safe'],
            [['status'], 'string'],
//            [['dates'], 'each', 'validateDates'],
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
            'date' => Yii::t('app', 'Date'),
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

    public function validateDates()
    {
        var_dump($this->dates);
    }
}
