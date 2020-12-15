<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "contacts".
 *
 * @property int $type_id
 * @property int $user_id
 * @property string $value
 *
 * @property ContactType $type
 * @property User $user
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'user_id', 'value'], 'required'],
            [['type_id', 'user_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['type_id', 'user_id'], 'unique', 'targetAttribute' => ['type_id', 'user_id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ContactType::class, 'targetAttribute' => ['type_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'type_id' => 'Type ID',
            'user_id' => 'User ID',
            'value' => 'Value',
        ];
    }

    /**
     * Gets query for [[Type]].
     *
     * @return ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ContactType::class, ['id' => 'type_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
