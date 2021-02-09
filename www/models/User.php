<?php

namespace app\models;

use app\models\queries\UsersQuery;
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
 * @property int|null $status
 * @property string|null $first_name
 * @property string|null $second_name
 * @property string|null $last_name
 * @property int|null $updated_at
 *
 * @property Contact[] $contacts
 * @property ContactType[] $types
 * @property DailySchedule[] $dailySchedules
 * @property MonthlySchedule[] $monthlySchedules
 * @property WeeklySchedule[] $weeklySchedules
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
            [['username', 'password', 'birthday', 'first_name', 'second_name', 'last_name'], 'required'],
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
            'first_name' => 'First name',
            'second_name' => 'Second name',
            'last_name' => 'Last name',
            'birthday' => 'Birthday',
            'created_at' => 'Created At',
            'modified_by' => 'Modified By',
            'gender' => 'Gender',
            'status' => 'Status',
        ];
    }

    public function getContacts(): ActiveQuery
    {
        return $this->hasMany(Contact::class, ['user_id' => 'id']);
    }
    
    public function getTypes()
    {
        return $this->hasMany(ContactType::class, ['id' => 'type_id'])->viaTable('contacts', ['user_id' => 'id']);
    }
    
    public function getDailySchedules(): ActiveQuery
    {
        return $this->hasMany(DailySchedule::class, ['user_id' => 'id']);
    }

    public function getMonthlySchedules(): ActiveQuery
    {
        return $this->hasMany(MonthlySchedule::class, ['user_id' => 'id']);
    }

    
    public function getWeeklySchedules(): ActiveQuery
    {
        return $this->hasMany(WeeklySchedule::class, ['user_id' => 'id']);
    }

    
    public static function find(): UsersQuery
    {
        return new UsersQuery(get_called_class());
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
