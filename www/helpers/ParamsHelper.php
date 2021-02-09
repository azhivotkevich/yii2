<?php


namespace app\helpers;


use yii\helpers\ArrayHelper;

class ParamsHelper
{
    public static function getLanguageShortcut(): string
    {
        $lang = \Yii::$app->language;
        return ArrayHelper::getValue(\Yii::$app->params, "languageShortcuts.{$lang}", 'en');
    }
}