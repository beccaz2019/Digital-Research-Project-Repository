<?php

namespace app\controllers;

use app\models\ProjectDeveloper;
use app\models\ProjectDeveloperSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjectDeveloperController implements the CRUD actions for ProjectDeveloper model.
 */
class ProjectDeveloperController extends Controller
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
            ]
        );
    }

    /**
     * Lists all ProjectDeveloper models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProjectDeveloperSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectDeveloper model.
     * @param int $developer_id Developer ID
     * @param int $project_id Project ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($developer_id, $project_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($developer_id, $project_id),
        ]);
    }

    /**
     * Creates a new ProjectDeveloper model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ProjectDeveloper();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'developer_id' => $model->developer_id, 'project_id' => $model->project_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProjectDeveloper model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $developer_id Developer ID
     * @param int $project_id Project ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($developer_id, $project_id)
    {
        $model = $this->findModel($developer_id, $project_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'developer_id' => $model->developer_id, 'project_id' => $model->project_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProjectDeveloper model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $developer_id Developer ID
     * @param int $project_id Project ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($developer_id, $project_id)
    {
        $this->findModel($developer_id, $project_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProjectDeveloper model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $developer_id Developer ID
     * @param int $project_id Project ID
     * @return ProjectDeveloper the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($developer_id, $project_id)
    {
        if (($model = ProjectDeveloper::findOne(['developer_id' => $developer_id, 'project_id' => $project_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
