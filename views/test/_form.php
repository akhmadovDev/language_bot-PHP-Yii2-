<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Test $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="test-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'words_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'all_attemp')->textInput() ?>

    <?= $form->field($model, 'last_attemp')->textInput() ?>

    <?= $form->field($model, 'correct')->textInput() ?>

    <?= $form->field($model, 'incorrect')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
