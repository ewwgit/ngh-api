<?php

namespace app\modules\doctors\models;

use Yii;
use yii\validators\RequiredValidator;

/**
 * This is the model class for table "doctor_slots".
 *
 * @property integer $docslotId
 * @property integer $dsDoctorId
 * @property string $day
 * @property string $startTime
 * @property string $endTime
 */
class DoctorSlots extends \yii\db\ActiveRecord
{
	public $slotsInfo;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctor_slots';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            /* [['dsDoctorId', 'day', 'startTime', 'endTime'], 'required'],
            [['dsDoctorId'], 'integer'],
            [['day', 'startTime', 'endTime'], 'string', 'max' => 20], */
        	[['slotsInfo'],'safe'],
        	['slotsInfo', 'validateSlotinfo'],
        	['slotsInfo', 'validateSlotinfostart'],
        	['slotsInfo', 'validateSlotinfoend'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'docslotId' => 'Docslot ID',
            'dsDoctorId' => 'Ds Doctor ID',
            'day' => 'Day',
            'startTime' => 'Start Time',
            'endTime' => 'End Time',
        ];
    }
    
    public function validateSlotinfo($attribute)
    {
    	$requiredValidator = new RequiredValidator();
    	 
    
    	foreach($this->$attribute as $index => $row) {
    		$error = null;
    		$requiredValidator->validate($row['day'], $error);
    		if (!empty($error)) {
    			$key = $attribute . '[' . $index . '][day]';
    			$this->addError($key, 'Day cannot be blank.');
    		}
    		
    
    
    
    	}
    }
    
    public function validateSlotinfostart($attribute)
    {
    	$requiredValidator = new RequiredValidator();
    
    
    	foreach($this->$attribute as $index => $row) {
    		$error = null;
    		$requiredValidator->validate($row['startTime'], $error);
    		if (!empty($error)) {
    			$key = $attribute . '[' . $index . '][startTime]';
    			$this->addError($key, 'Start Time cannot be blank.');
    		}
    		
    		if($row['startTime'] != '' && $row['endTime'] != '')
    		{
    			if(strtotime($row['startTime']) >= strtotime($row['endTime']))
    			{
    				$key = $attribute . '[' . $index . '][endTime]';
    				$this->addError($key, 'End Time greater than start time.');
    			}
    		}
    
    
    
    
    	}
    }
    
    public function validateSlotinfoend($attribute)
    {
    	$requiredValidator = new RequiredValidator();
    
    
    	foreach($this->$attribute as $index => $row) {
    		$error = null;
    		$requiredValidator->validate($row['endTime'], $error);
    		if (!empty($error)) {
    			$key = $attribute . '[' . $index . '][endTime]';
    			$this->addError($key, 'End Time cannot be blank.');
    		}
    		
    		if($row['startTime'] != '' && $row['endTime'] != '')
    		{
    			if(strtotime($row['startTime']) >= strtotime($row['endTime']))
    			{
    			$key = $attribute . '[' . $index . '][endTime]';
    			$this->addError($key, 'End Time greater than start time.');
    			}
    		}
    
    
    
    
    	}
    }
    
    public static function getSlotsInfo($docId) {
    
    	$SlotData = DoctorSlots::find()->asArray(true)->where(['dsDoctorId' => $docId ])->all();
    	return $SlotData;
    }
}
