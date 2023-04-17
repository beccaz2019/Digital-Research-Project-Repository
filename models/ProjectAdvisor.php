<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_advisor".
 *
 * @property int $id
 */
class ProjectAdvisor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_advisor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjectAdvisorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectAdvisorQuery(get_called_class());
    }
}
