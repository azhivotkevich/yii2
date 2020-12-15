<?php

namespace app\models\forms;

use app\models\User;
use yii\base\Model;

/**
 * Class SignUpDoctorForm
 * @package app\models\forms
 */
class SignUpClientForm extends AbstractSignUpForm
{
    public function rules()
    {
        $baseRules = parent::rules();
        $clientRules = [];

        return array_merge($baseRules, $clientRules);
    }
}
