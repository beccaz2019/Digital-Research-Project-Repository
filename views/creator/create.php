<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Creator $model */

$this->title = 'Create Creator';
$this->params['breadcrumbs'][] = ['label' => 'Creators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="creator-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
