<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\WordsAudio $model */

$this->title = Yii::t('app', 'Create Words Audio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Words Audios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="words-audio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
