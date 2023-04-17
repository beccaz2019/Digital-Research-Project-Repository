<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProjectAdvisor]].
 *
 * @see ProjectAdvisor
 */
class ProjectAdvisorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjectAdvisor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjectAdvisor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
