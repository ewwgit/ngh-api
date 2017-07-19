<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin_information".
 *
 * @property integer $adId
 * @property integer $aduserId
 * @property string $firstName
 * @property string $lastName
 * @property string $address
 * @property string $profileImage
 *
 * @property User $aduser
 */
class AdminInformation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_information';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aduserId', 'firstName', 'lastName', 'address', 'profileImage','phoneNumber'], 'safe'],
        	[['firstName','lastName'] ,'required'],
        	[['phoneNumber'],'integer'],
            [['aduserId'], 'integer'],
            [['address', 'profileImage'], 'string'],
            [['firstName', 'lastName'], 'string', 'max' => 200],
            //[['aduserId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['aduserId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'adId' => 'Ad ID',
            'aduserId' => 'Aduser ID',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'address' => 'Address',
            'profileImage' => 'Profile Image',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAduser()
    {
        return $this->hasOne(User::className(), ['id' => 'aduserId']);
    }
}
