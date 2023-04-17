<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "advisor".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property int|null $department_id
 *
 * @property Department $department
 * @property ProjectAdvisor[] $projectAdvisors
 * @property Project[] $projects
 */
class Advisor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'advisor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['department_id'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 50],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::class, 'targetAttribute' => ['department_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'department_id' => Yii::t('app', 'Department ID'),
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::class, ['id' => 'department_id']);
    }

    /**
     * Gets query for [[ProjectAdvisors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectAdvisors()
    {
        return $this->hasMany(ProjectAdvisor::class, ['advisor_id' => 'id']);
    }

    /**
     * Gets query for [[Projects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::class, ['advisor_id' => 'id']);
    }

    public function getFull_Name()
    {
        return "{$this->first_name} {$this->last_name} ";

    }
}
