<?php

namespace app\models;

use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $birthday
 * @property string|null $created_at
 * @property int|null $modified_by
 * @property string|null $gender
 * @property string|null $status
 *
 * @property Contact[] $contacts
 * @property ContactType[] $types
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'birthday'], 'required'],
            [['birthday', 'created_at'], 'safe'],
            [['modified_by'], 'integer'],
            [['gender', 'status'], 'string'],
            [['username', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => 'Name',
            'password' => 'Password',
            'birthday' => 'Birthday',
            'created_at' => 'Created At',
            'modified_by' => 'Modified By',
            'gender' => 'Gender',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Contacts]].
     *
     * @return ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contact::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Types]].
     *
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getTypes()
    {
        return $this->hasMany(ContactType::class, ['id' => 'type_id'])->viaTable('contacts', ['user_id' => 'id']);
    }

    public static function findEntityByName(string $username): ?User
    {
        return self::findOne(['username' => $username]);
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
    }

    public function validateAuthKey($authKey)
    {
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
    }
}
