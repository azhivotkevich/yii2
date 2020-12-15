<?php


namespace app\models\forms;


use app\models\User;
use yii\base\Model;

abstract class AbstractSignUpForm extends Model
{
    public $username;
    public $first_name;
    public $second_name;
    public $last_name;
    public $birthday;
    public $password;
    public $passwordRepeat;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['birthday', 'filter', 'filter' => function($value) {
                return (new \DateTime($value))->format('Y-m-d');
            }],
            [[
                'username',
                'password',
                'passwordRepeat',
                'birthday',
                'first_name',
                'second_name',
                'last_name'
            ],
                'required'],

            [['username'], 'string', 'min' => 3, 'max' => 20],
            [['first_name'], 'string', 'min' => 3, 'max' => 30],
            [['second_name'], 'string', 'min' => 3, 'max' => 30],
            [['last_name'], 'string', 'min' => 3, 'max' => 30],

            [['username'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'name'],
            [['password', 'passwordRepeat'], 'string', 'min' => 6, 'max' => 20],
            [['birthday'], 'birthdayValidator'],
            [['passwordRepeat'], 'compare', 'compareAttribute' => 'password'],
        ];
    }

    public function register(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $user = new User();
        $user->name = $this->username;
        $user->birthday = $this->birthday;
        $user->password = \Yii::$app->getSecurity()->generatePasswordHash($this->password);

        return $user->save();
    }

    public function birthdayValidator(string $attribute)
    {
        $birtday = new \DateTime($this->{$attribute});
        $currentDay = new \DateTime();

        $diff = $currentDay->diff($birtday);

        if ($diff->y < 18) {
            $this->addError($attribute, 'You must be 18y or older');
            return false;
        }

        return true;
    }
}