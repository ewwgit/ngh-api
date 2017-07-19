<?php

namespace app\modules\qualifications\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\qualifications\models\Qualifications;

/**
 * QualificationsSearch represents the model behind the search form about `app\modules\qualifications\models\Qualifications`.
 */
class QualificationsSearch extends Qualifications
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qlid', 'createdBy', 'updatedBy'], 'integer'],
            [['qualification', 'status', 'createdDate', 'updatedDate'], 'safe'],
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
        $query = Qualifications::find();

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
            'qlid' => $this->qlid,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
            'createdDate' => $this->createdDate,
            'updatedDate' => $this->updatedDate,
        ]);

        $query->andFilterWhere(['like', 'qualification', $this->qualification])
          //  ->andFilterWhere(['like', 'status', $this->status]);
            ->andFilterWhere(['=', 'status', $this->status]);

        return $dataProvider;
    }
}
