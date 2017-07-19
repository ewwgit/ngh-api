<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "states".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $country_id
 */
class States extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'states';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['country_id'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['code'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
            'country_id' => 'Country ID',
        ];
    }
 public static function getStateName($stateId)
    {
    	$statesModel = States::find()->select(['name'])->asArray()->where(['id'=>$stateId])
    	->one();
    	return $statesModel['name'];
    }
}
