<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TestDetail $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="test-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'test_id')->textInput() ?>

    <?= $form->field($model, 'attemp')->textInput() ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
