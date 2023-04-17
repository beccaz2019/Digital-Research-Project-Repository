<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Project $model */
/** @var yii\widgets\ActiveForm $form */
$items = \yii\helpers\ArrayHelper::map(
    \app\models\Advisor::find()
       // ->select(['CONCAT(first_name, " ", last_name) AS full_name'])
        ->all(), // query
    'id',  'full_name'  // field names
 );
 
 $departments = \yii\helpers\ArrayHelper::map(
    \app\models\Department::find()
        ->all(), // query
    'id',  'name'  // field names
 );
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'advisor_id')->dropDownList(
            $items,          // Flat array ('id'=>'label')
            ['prompt' => '-- Select One --']    // options
    )->label ('Advisor');
     ?>

    <?= $form->field($model, 'is_remunerated')->dropDownList(
            [
                1 => "Yes",
                0 => "No" ,
            ]  ,         // Flat array ('id'=>'label')
            ['prompt' => '-- Select One --']    // options
        ); ?>
    <?= $form->field($model, 'domain')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'department_id')->dropDownList(
            $departments,          // Flat array ('id'=>'label')
            ['prompt' => '-- Select One --',
            'disabled' => ($model->department_id > 0),
            ]    // options
    )->label ('Department');
     ?>
   

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>



    <?php ActiveForm::end(); ?>

</div>
