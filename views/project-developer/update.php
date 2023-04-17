<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ProjectDeveloper $model */

$this->title = Yii::t('app', 'Update Project Developer: {name}', [
    'name' => $model->developer_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Developers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->developer_id, 'url' => ['view', 'developer_id' => $model->developer_id, 'project_id' => $model->project_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="project-developer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
