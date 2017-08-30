<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_security_tokens".
 *
 * @property integer $usecId
 * @property integer $userId
 * @property string $token
 * @property string $status
 * @property string $createdDate
 * @property string $expiredDate
 */
class UserSecurityTokens extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_security_tokens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'token', 'status', 'createdDate', 'expiredDate'], 'safe'],
           /*  [['userId'], 'integer'],
            [['status'], 'string'],
            [['createdDate', 'expiredDate'], 'safe'],
            [['token'], 'string', 'max' => 255], */
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'usecId' => 'Usec ID',
            'userId' => 'User ID',
            'token' => 'Token',
            'status' => 'Status',
            'createdDate' => 'Created Date',
            'expiredDate' => 'Expired Date',
        ];
    }
}
