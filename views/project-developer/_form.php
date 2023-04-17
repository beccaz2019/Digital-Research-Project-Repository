<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ProjectDeveloper $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="project-developer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'developer_id')->textInput() ?>

    <?= $form->field($model, 'project_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
