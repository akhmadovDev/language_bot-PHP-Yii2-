<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TestDetail $model */

$this->title = Yii::t('app', 'Create Test Detail');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Test Details'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
