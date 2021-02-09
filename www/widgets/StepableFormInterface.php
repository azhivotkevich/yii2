<?php


namespace app\widgets;


use yii\widgets\ActiveForm;

interface StepableFormInterface
{
    public function getFields(ActiveForm $form, array $completedSteps): array;
    public function hasSubmitButton(): bool;
    public function isSavable(): bool;
}