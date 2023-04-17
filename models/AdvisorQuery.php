<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Advisor]].
 *
 * @see Advisor
 */
class AdvisorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Advisor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Advisor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
