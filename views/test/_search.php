<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TestSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="test-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'words_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'all_attemp') ?>

    <?= $form->field($model, 'last_attemp') ?>

    <?php // echo $form->field($model, 'correct') ?>

    <?php // echo $form->field($model, 'incorrect') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
