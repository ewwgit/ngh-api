<?php
namespace app\modules\nursinghomes\models;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\nursinghomes\models\Nursinghomes;

/**
 * NursinghomesSearch represents the model behind the search form about `app\models\Nursinghomes`.
 */
class NursinghomesSearch extends Nursinghomes
{
    /**
     * @inheritdoc
     */
	public $username;
	public $email;
	public $status;
	public $role;
	
	
    public function rules()
    {
        return [
            [['nursingId', 'nuserId', 'state', 'country', 'createdBy', 'updatedBy','role'], 'integer'],
            [['status','username','email','nurshingUniqueId', 'contactPerson', 'mobile', 'city', 'stateName', 'countryName', 'pinCode', 'address', 'description',
            		'createdDate', 'updatedDate','role'
            		
            ], 'safe'],
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
        $query = Nursinghomes::find();
        
     

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        'sort' => ['attributes' => ['status','username','email','nurshingUniqueId', 'contactPerson', 'mobile', 'city', 'stateName', 'countryName', 'pinCode', 'address', 'description', 'createdDate', 'updatedDate']],
        		 
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        
        $query->joinWith('user');

        // grid filtering conditions
        $query->andFilterWhere([
            'nursingId' => $this->nursingId,
            'nuserId' => $this->nuserId,
            'state' => $this->state,
            'country' => $this->country,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
            'createdDate' => $this->createdDate,
            'updatedDate' => $this->updatedDate,
        ]);

        $query->andFilterWhere(['like', 'nurshingUniqueId', $this->nurshingUniqueId])
            ->andFilterWhere(['like', 'contactPerson', $this->contactPerson])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'stateName', $this->stateName])
            ->andFilterWhere(['like', 'countryName', $this->countryName])
            ->andFilterWhere(['like', 'pinCode', $this->pinCode])
            ->andFilterWhere(['like', 'user.username', $this->username])
           // ->andFilterWhere(['like', 'user.status', $this->status])
            ->andFilterWhere(['=', 'user.status', $this->status])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
