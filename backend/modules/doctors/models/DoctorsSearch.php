<?php

namespace app\modules\doctors\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\doctors\models\Doctors;

/**
 * DoctorsSearch represents the model behind the search form about `app\modules\doctors\models\Doctors`.
 */
class DoctorsSearch extends Doctors
{
    /**
     * @inheritdoc
     */
	public $username;
	public $email;
	
    public function rules()
    {
        return [
            [['doctorid', 'userId', 'state', 'country', 'createdBy', 'updatedBy'], 'integer'],
            [['username','email','doctorUniqueId', 'name', 'qualification', 'city', 'stateName', 'countryName', 'address', 'pinCode', 'doctorMobile', 'doctorImage', 'summery', 'APMC', 'TSMC', 'createdDate', 'updatedDate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Doctors::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        		'sort' => ['attributes' => ['username','email','doctorUniqueId', 'name', 'qualification', 'city', 'stateName', 'countryName', 'address', 'pinCode', 'doctorMobile', 'doctorImage', 'summery', 'APMC', 'TSMC', 'createdDate', 'updatedDate']],
        		
        		
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $query->joinWith('user');
        // grid filtering conditions
       // print_r($query);exit();
        $query->andFilterWhere([
            'doctorid' => $this->doctorid,
            'userId' => $this->userId,
            'state' => $this->state,
            'country' => $this->country,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
            'createdDate' => $this->createdDate,
            'updatedDate' => $this->updatedDate,
        ]);

        $query->andFilterWhere(['like', 'doctorUniqueId', $this->doctorUniqueId])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'qualification', $this->qualification])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'stateName', $this->stateName])
            ->andFilterWhere(['like', 'countryName', $this->countryName])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'pinCode', $this->pinCode])
            ->andFilterWhere(['like', 'user.username', $this->username])
            ->andFilterWhere(['like', 'doctorMobile', $this->doctorMobile])
            ->andFilterWhere(['like', 'doctorImage', $this->doctorImage])
            ->andFilterWhere(['like', 'summery', $this->summery])
            ->andFilterWhere(['like', 'APMC', $this->APMC])
            ->andFilterWhere(['like', 'TSMC', $this->TSMC]);

        return $dataProvider;
    }
}
