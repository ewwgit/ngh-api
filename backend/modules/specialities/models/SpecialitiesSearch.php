<?php

namespace app\modules\specialities\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\specialities\models\Specialities;

/**
 * SpecialitiesSearch represents the model behind the search form about `app\modules\specialities\models\Specialities`.
 */
class SpecialitiesSearch extends Specialities
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['spId', 'createdBy', 'updatedBy'], 'integer'],
            [['specialityName', 'specialityCode', 'description', 'status', 'createdDate', 'updatedDate'], 'safe'],
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
        $query = Specialities::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'spId' => $this->spId,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
            'createdDate' => $this->createdDate,
            'updatedDate' => $this->updatedDate,
        ]);

        $query->andFilterWhere(['like', 'specialityName', $this->specialityName])
            ->andFilterWhere(['like', 'specialityCode', $this->specialityCode])
            ->andFilterWhere(['like', 'description', $this->description])
            //->andFilterWhere(['like', 'status', $this->status]);
            ->andFilterWhere(['=', 'status', $this->status]);
    
        return $dataProvider;
    }
}
