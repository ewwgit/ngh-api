<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ModulesMaster;

/**
 * ModulesMasterSearch represents the model behind the search form about `app\models\ModulesMaster`.
 */
class ModulesMasterSearch extends ModulesMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['moduleId', 'createdBy', 'updatedBy'], 'integer'],
            [['moduleName', 'type', 'status', 'createdDate', 'updatedDate', 'ipAddress'], 'safe'],
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
        $query = ModulesMaster::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        		'pagination' => [
        				'pageSize' => 25,
        		],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'moduleId' => $this->moduleId,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
            'createdDate' => $this->createdDate,
            'updatedDate' => $this->updatedDate,
        ]);

        $query->andFilterWhere(['like', 'moduleName', $this->moduleName])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['=', 'status', $this->status])
           // ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'ipAddress', $this->ipAddress]);

        return $dataProvider;
    }
}
