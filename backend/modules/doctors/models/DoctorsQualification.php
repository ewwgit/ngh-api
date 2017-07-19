<?php

namespace app\modules\doctors\models;

use Yii;

/**
 * This is the model class for table "doctors_qualification".
 *
 * @property integer $dqId
 * @property integer $docId
 * @property string $qualification
 */
class DoctorsQualification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctors_qualification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['docId', 'qualification'], 'required'],
            [['docId'], 'integer'],
            //[['qualification'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dqId' => 'Dq ID',
            'docId' => 'Doc ID',
            'qualification' => 'Qualification',
        ];
    }
}
