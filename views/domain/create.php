<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Domain $model */

$this->title = Yii::t('app', 'Create Domain');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Domains'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="domain-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
