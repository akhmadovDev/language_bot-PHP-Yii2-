<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\WordsSample $model */

$this->title = Yii::t('app', 'Create Words Sample');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Words Samples'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="words-sample-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
