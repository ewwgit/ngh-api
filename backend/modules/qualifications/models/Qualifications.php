<?php

namespace app\modules\qualifications\models;

use Yii;

/**
 * This is the model class for table "qualifications".
 *
 * @property integer $qlid
 * @property string $qualification
 * @property string $status
 * @property integer $createdBy
 * @property integer $updatedBy
 * @property string $createdDate
 * @property string $updatedDate
 */
class Qualifications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qualifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qualification', 'status', 'createdBy', 'updatedBy', 'createdDate', 'updatedDate'], 'required'],
            [['status'], 'string'],
            [['createdBy', 'updatedBy'], 'integer'],
            [['createdDate', 'updatedDate'], 'safe'],
            //[['qualification'], 'string', 'max' => 50],
        		['qualification',
        		'match',
        		'pattern' => '/^[A-Za-z ]+$/  ',
        		'message' => ' Invalid Qualification Only alphabets are allowed',
        		],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'qlid' => 'Qualification Id',
            'qualification' => 'Qualification',
            'status' => 'Status',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
        ];
    }
}
