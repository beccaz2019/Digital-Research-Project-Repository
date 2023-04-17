<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Creator $model */

$this->title = 'Update Creator: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Creators', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="creator-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
