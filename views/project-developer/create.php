<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ProjectDeveloper $model */

$this->title = Yii::t('app', 'Create Project Developer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Developers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-developer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
