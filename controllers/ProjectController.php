<?php

namespace app\controllers;

use app\models\Project;
use app\models\ProjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::className(),
                    //'only' => ['index', 'create', 'view', 'update', 'delete'],  // comment this if all pages require auth
                    'rules' => [
                        [  // Guest users
                          'allow' => true,
                         'actions' => ['index', 'view'],
                         'roles' => ['?'],  // ? = Guest user
                        ],
                        [   // Authenticated users
                            'actions' => ['index', 'view', 'create'],
                            'allow' => true,
                            'roles' => ['@'],  // @ = Authenticated users
                        ],
                        [   // Admin users
                            'actions' => ['index', 'create', 'view', 'update', 'delete'],
                            'allow' => true,
                            'matchCallback' => function ($rule, $action) {
                                //return (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin());
                                //return (isset(Yii::$app->user->identity) && (Yii::$app->user->identity->role === 'admin'));
                                return (isset(Yii::$app->user->identity) && (Yii::$app->user->identity->username === 'admin'));
                             }
                        ],
                        [   // Admin users
                            'actions' => [ 'update', 'delete'],
                            'allow' => true,
                            'matchCallback' => function ($rule, $action) {
                                //return (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin());
                                //return (isset(Yii::$app->user->identity) && (Yii::$app->user->identity->role === 'admin'));
                                // Get model
                                $project = null;
                                $project_id = @ (Yii::$app->request->get('id') ?: Yii::$app->request->post('id'));  // param passed to view.  Eg: '/presentation/manage-files?presentation_id=123'
                                if ($project_id) {
                                    $project = Project::findOne($project_id);
                                }
 
                                // Check permissions
                                return (isset(Yii::$app->user->identity) && (Yii::$app->user->identity->department_id === $project->department_id));
                             }
                        ],
                    ],
                ],
                //...
            ]
        
        );
    }

    /**
     * Lists all Project models.
     *
     * @return string
     */
    public function actionIndex($department_id = 0)
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        if ($department_id > 0) {
            $dataProvider->query->andWhere(['department_id' => $department_id]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'department_id' => $department_id,
        ]);
    }

    /**
     * Displays a single Project model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Project();
        $model->department_id = Yii::$app->user->identity->department_id; 


        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
