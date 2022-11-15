<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Words $model */

$this->title = Yii::t('app', 'Create Words');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Words'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="words-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
