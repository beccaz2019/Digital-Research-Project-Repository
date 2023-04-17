<?php

use app\models\ProjectDeveloper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ProjectDeveloperSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Project Developers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-developer-index">

    <h1><?= Html::encode($this->title) ?></h1>

<?php if ($department_id == Yii::$app->user->identity->department_id): ?> 
    <p>
        <?= Html::a(Yii::t('app', 'Create Project Developer'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php endif; ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'developer_id',
            'project_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ProjectDeveloper $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'developer_id' => $model->developer_id, 'project_id' => $model->project_id]);
                 }
            ],
        ],
    ]); ?>


</div>
