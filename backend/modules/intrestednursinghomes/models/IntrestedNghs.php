<?php

namespace app\modules\intrestednursinghomes\models;

use Yii;

/**
 * This is the model class for table "intrested_nghs".
 *
 * @property integer $insnghid
 * @property string $name
 * @property string $email
 * @property integer $role
 * @property string $description
 * @property string $mobile
 * @property string $createdDate
 */
class IntrestedNghs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'intrested_nghs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email','description', 'mobile'], 'required'],
            [['role','mobile'], 'integer'],
            [['description'], 'string'],
            [['createdDate'], 'safe'],

        		['name', 'string', 'min' => 2, 'max' => 255],
        		//['name', 'unique', 'message' => 'This name has already been taken.'],
        		
        		[
        		'mobile',
        		'match',
        		'pattern'=>'/^[0-9]{10}$/',
        		'message' => 'should contain  max 10  number',
        		],
        		[
        		'email',
        		'match',
        		'pattern' => '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',
        		'message' => 'Email can contain @ and .com characters.'
        		 ],
        		 ['email', 'string', 'max' => 255],
        		 ['email', 'unique', 'message' => 'This email address has already been taken.'],
        	     ['email','email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'insnghid' => 'Insnghid',
            'name' => 'Name',
            'email' => 'Email',
            'role' => 'Role',
            'description' => 'Description',
            'mobile' => 'Mobile',
            'createdDate' => 'Created Date',
        ];
    }
}
