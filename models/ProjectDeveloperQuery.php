<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProjectDeveloper]].
 *
 * @see ProjectDeveloper
 */
class ProjectDeveloperQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjectDeveloper[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjectDeveloper|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
