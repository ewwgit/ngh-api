<?php

namespace app\modules\doctors\models;

use Yii;

/**
 * This is the model class for table "doctors_specialities".
 *
 * @property integer $docspId
 * @property integer $rdoctorId
 * @property integer $rspId
 */
class DoctorsSpecialities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctors_specialities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rdoctorId', 'rspId'], 'required'],
            [['rdoctorId', 'rspId'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'docspId' => 'Docsp ID',
            'rdoctorId' => 'Rdoctor ID',
            'rspId' => 'Rsp ID',
        ];
    }
}
