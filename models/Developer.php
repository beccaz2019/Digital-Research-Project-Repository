<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Developer".
 *
 * @property int $id
 * @property string $developer_name
 */
class Developer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Developer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['developer_name'], 'required'],
            [['developer_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'developer_name' => Yii::t('app', 'Developer Name'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return DeveloperQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DeveloperQuery(get_called_class());
    }
}
