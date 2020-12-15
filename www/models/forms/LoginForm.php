<?php

namespace app\models\forms;

use app\models\User;
use yii\base\Model;

/**
 * Class SignUpDoctorForm
 * @package app\models\forms
 */
class LoginForm extends Model
{
    public $username;
    public $password;

    private $userModel = null;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['password'], 'passwordValidator'],
            [['password'], 'statusValidator'],
        ];
    }

    public function login(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $user = $this->getUser();
        \Yii::$app->user->login($user);

        return true;
    }

    public function getUser(): ?User
    {
        if (null === $this->userModel) {
            $this->userModel = User::findEntityByName($this->username);
        }
        return $this->userModel;
    }

    public function passwordValidator(string $attribute): bool
    {
        $user = $this->getUser();

        if (!$user) {
            $this->addError($attribute, 'Username or password is incorrect');
            $this->addError('username');
            return false;
        }

        try {
            $hash = \Yii::$app->getSecurity()->validatePassword($this->password, $user->password);
        } catch (\Exception $exception) {
            $this->addError($attribute, 'Username or password is incorrect');
            $this->addError('username');
            return false;
        }

        if (!$hash) {
            $this->addError($attribute, 'Username or password is incorrect');
            $this->addError('username');
            return false;
        }

        return true;
    }

    public function statusValidator(string $attribute): bool
    {
        $user = $this->getUser();
        if ($user->status == 'inactive') {
            $this->addError($attribute, 'You are not allowed to login');
            $this->addError('username');
            return false;
        }

        return true;
    }
}
