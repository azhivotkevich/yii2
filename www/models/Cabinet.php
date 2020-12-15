<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cabinets".
 *
 * @property int $id
 * @property int $salon_id
 * @property string $name
 *
 * @property Salon $salon
 */
class Cabinet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cabinets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['salon_id', 'name'], 'required'],
            [['salon_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['salon_id'], 'exist', 'skipOnError' => true, 'targetClass' => Salon::class, 'targetAttribute' => ['salon_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'salon_id' => Yii::t('app', 'Salon ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * Gets query for [[Salon]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSalon()
    {
        return $this->hasOne(Salon::class, ['id' => 'salon_id']);
    }
}
