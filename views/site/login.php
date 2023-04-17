<?php

/*

/** @var yii\web\View $this * /
/** @var yii\bootstrap5\ActiveForm $form * /
/** @var app\models\LoginForm $model * /

// use yii\bootstrap5\ActiveForm;
// use yii\bootstrap5\Html;

// $this->title = 'Login';
// $this->params['breadcrumbs'][] = $this->title;
// ? >
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

     <? php  $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"offset-lg-1 col-lg-3 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?> -->

        <div class="form-group">
            <div class="offset-lg-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    <div class="offset-lg-1" style="color:#999;">
        You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
    </div>
</div> 
*/ ?>
<!-- 
///////////
///////////
\\\\\\\\\\\
\\\\\\\\\\\\ -->
<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
 
/* @var $this yii\web\View */
/* @var $form yii\bootstrap5\ActiveForm */
/* @var $model \app\models\LoginForm */
 
$this->title = 'Sign In';
 
$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];
 
$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>
 
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>L</b>ogin</a>
    </div>
    <div class="login-box-body login">
        <p class="login-box-msg">Login</p>
 
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>
 
        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
 
        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
 
        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <div class="col-xs-4">
                <?= Html::submitButton('Sign in', [
                    'class' => 'btn btn-primary btn-block btn-flat', 
                    'name' => 'login-button']
                ) ?>
            </div>
        </div>
 
        <?php ActiveForm::end(); ?>
 
    </div>
 
</div>