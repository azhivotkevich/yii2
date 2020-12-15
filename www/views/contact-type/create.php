<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ContactType */

$this->title = 'Create Contact Type';
$this->params['breadcrumbs'][] = ['label' => 'Contact Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
