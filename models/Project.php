<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $title
 * @property int|null $advisor_id
 * @property int|null $is_remunerated
 * 
 *
 * @property Advisor $advisor
 * @property Developer[] $developers
 * @property ProjectAdvisor[] $projectAdvisors
 * @property ProjectDeveloper[] $projectDevelopers
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'required'],
            [['advisor_id', 'is_remunerated'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 500],
            [['domain'], 'string', 'max' => 200],
            [['department_id'],'exist', 'skipOnError' => true ],
            [['advisor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Advisor::class, 'targetAttribute' => ['advisor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'advisor_id' => Yii::t('app', 'Advisor ID'),
            'is_remunerated' => Yii::t('app', 'Is Remunerated?'),
        ];
    }

    /**
     * Gets query for [[Advisor]].
     *
     * @return \yii\db\ActiveQuery|AdvisorQuery
     */
    public function getAdvisor()
    {
        return $this->hasOne(Advisor::class, ['id' => 'advisor_id']);
    }

    /**
     * Gets query for [[Developers]].
     *
     * @return \yii\db\ActiveQuery|DeveloperQuery
     */
    public function getDevelopers()
    {
        return $this->hasMany(Developer::class, ['id' => 'developer_id'])->viaTable('project_developer', ['project_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery|TaskQuery
     */
    // public function getTasks()
    // {
    //     return $this->hasMany(Task::class, ['id' => 'task_id']);
    // }

    /**
     * Gets query for [[ProjectAdvisors]].
     *
     * @return \yii\db\ActiveQuery|ProjectAdvisorQuery
     */
    public function getProjectAdvisors()
    {
        return $this->hasMany(ProjectAdvisor::class, ['project_id' => 'id']);
    }

    /**
     * Gets query for [[ProjectDevelopers]].
     *
     * @return \yii\db\ActiveQuery|ProjectDeveloperQuery
     */
    public function getProjectDevelopers()
    {
        return $this->hasMany(ProjectDeveloper::class, ['project_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ProjectQuery the active query used by this AR class.
     */
    /*
    public static function find()
    {
        return new ProjectQuery(get_called_class());
    }
    */
}
