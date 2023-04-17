<?php

use app\models\Project;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


/** @var yii\web\View $this */
/** @var app\models\ProjectSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Projects');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>

<?php if (!Yii::$app->user->isGuest && ($department_id == Yii::$app->user->identity->department_id)): ?> 
    <p>
        <?= Html::a(Yii::t('app', 'Create Project'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php endif; ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'title',
            [
                'attribute' => 'title',
                'label' => 'Title',
                'format' => 'raw',
                // 'value' => function($model){
                //     //$tasks = Task::find()->all();
                //     $strTasks = '';
                //     foreach ($model->tasks as $task) {
                //     $strTasks = '';
                //         $strTasks .= $task->name;
                //     }
                //     return ($model->title) . ' '
                //         . Html::a(Yii::t('app', 'Add Tasks'), ['task/create', 'project_id' => $model->id], ['class' => 'btn btn-success'])
                //         . $strTasks;
                // }
                
            ],
                //description
            [
                'attribute' => 'description',
                'label' => 'Description',
                'format' => 'raw',
            ],

            //'advisor_id', 
            [
                'attribute' => 'advisor_id',
                'label' => 'Advisor',
                'format' => 'raw',
                'value' => function($model){
                    return ($model->advisor->full_name);
                }
            ],
            'domain',
            'is_remunerated:boolean',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Project $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                 'visible' => false
            ],
            //['class' => 'yii\grid\ActionColumn', 'visible' => false],
            [   // custom actions for Bootstrap 4 support (using FontAwesome 4 icons)
                'class'    => 'yii\grid\ActionColumn',
                'template' => (Yii::$app->user->isGuest ? '{view}' : '{view} {update} {delete}'),
                'buttons'  => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-eye"></i>',
                            ['view', 'id' => $model->id]
                        );  // view record
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-pencil"></i>',
                            ['update', 'id' => $model->id]
                        );  // update record
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-trash-o"></i>',
                            ['delete', 'id' => $model->id],
                            [
                                'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ]
                            ]
                        ); // delete record
                    },
                ],
            ],

        ],
        

    ]); ?>


</div>
