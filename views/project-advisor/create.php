<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ProjectAdvisor $model */

$this->title = Yii::t('app', 'Create Project Advisor');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Advisors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-advisor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
