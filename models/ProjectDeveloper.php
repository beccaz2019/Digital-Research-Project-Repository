<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_developer".
 *
 * @property int $developer_id
 * @property int $project_id
 *
 * @property Developer $developer
 * @property Project $project
 */
class ProjectDeveloper extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_developer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['developer_id', 'project_id'], 'required'],
            [['developer_id', 'project_id'], 'integer'],
            [['developer_id', 'project_id'], 'unique', 'targetAttribute' => ['developer_id', 'project_id']],
            [['developer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Developer::class, 'targetAttribute' => ['developer_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::class, 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'developer_id' => Yii::t('app', 'Developer ID'),
            'project_id' => Yii::t('app', 'Project ID'),
        ];
    }

    /**
     * Gets query for [[Developer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeveloper()
    {
        return $this->hasOne(Developer::class, ['id' => 'developer_id']);
    }

    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery
     */
    /* public function getProject()
    {
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    } */
}
