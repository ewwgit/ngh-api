<?php

namespace app\modules\patients\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "patient_documents".
 *
 * @property integer $pdocumentId
 * @property integer $patientInfoId
 * @property string $documentUrl
 */
class PatientDocuments extends \yii\db\ActiveRecord
{
	public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patient_documents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pdocumentId', 'patientInfoId', 'documentUrl','file'], 'safe'],
            /* [['pdocumentId', 'patientInfoId'], 'integer'],
            [['documentUrl'], 'string'], */
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pdocumentId' => 'Pdocument ID',
            'patientInfoId' => 'Patient Info ID',
            'documentUrl' => 'Document Url',
        ];
    }
    
    public function upload()
    {
    	 
    	foreach ($this->file as $file) {
    		 
    		$patientdoc = new PatientDocuments();
    		$patientdoc->patientInfoId= $this->patientInfoId;
    		$imageName = rand(1000,100000).$file->baseName;
    		$patientdoc->documentUrl = 'patientdocuments/'.$imageName.'.'.$file->extension;
    		//$patientdoc->file = $patientdoc->imageUrl;
    		$patientdoc->save();
    		 
    		$file->saveAs('patientdocuments/' . $imageName . '.' . $file->extension);
    	}
    	return true;
    
    }
}
