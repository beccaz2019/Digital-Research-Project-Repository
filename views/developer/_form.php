<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Developer $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="developer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'developer_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
