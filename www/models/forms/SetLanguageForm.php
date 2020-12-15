<?php

namespace app\models\forms;

use app\models\User;
use Yii;
use yii\base\Model;

/**
 * Class SignUpDoctorForm
 * @package app\models\forms
 */
class SetLanguageForm extends Model
{
    public $language;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['language'], 'required'],
            [['language'], 'in', 'range' => array_keys(Yii::$app->params['languages'])],
        ];
    }

    public function set(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        Yii::$app->session->set('language', $this->language);

        return true;
    }
}
