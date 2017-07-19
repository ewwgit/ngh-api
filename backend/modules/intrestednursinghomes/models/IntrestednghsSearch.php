<?php

namespace app\modules\intrestednursinghomes\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\intrestednursinghomes\models\Intrestednghs;

/**
 * IntrestednghsSearch represents the model behind the search form about `app\modules\intrestednursinghomes\models\Intrestednghs`.
 */
class IntrestednghsSearch extends Intrestednghs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['insnghid', 'role'], 'integer'],
            [['name', 'email', 'description', 'mobile', 'createdDate'], 'safe'],
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
        $query = Intrestednghs::find();

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
            'insnghid' => $this->insnghid,
            'role' => $this->role,
            'createdDate' => $this->createdDate,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'mobile', $this->mobile]);

        return $dataProvider;
    }
}
