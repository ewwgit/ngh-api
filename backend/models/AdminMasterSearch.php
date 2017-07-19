<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AdminMaster;

/**
 * AdminMasterSearch represents the model behind the search form about `app\models\AdminMaster`.
 */
class AdminMasterSearch extends AdminMaster
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'roleId', 'status', 'createdBy', 'updatedBy'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'auth_key', 'email', 'firstName', 'lastName', 'profileImage', 'createdDate', 'updatedDate'], 'safe'],
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
        $query = AdminMaster::find()->where('admin.RoleId != 1');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        		'sort' => ['attributes' => ['username','email','status','role.RoleName']],
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
        $query->joinWith('role');
        $query->andFilterWhere([
            'id' => $this->id,
            'roleId' => $this->roleId,
            'status' => $this->status,
            'createdDate' => $this->createdDate,
            'updatedDate' => $this->updatedDate,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'firstName', $this->firstName])
            ->andFilterWhere(['like', 'lastName', $this->lastName])
            ->andFilterWhere(['like', 'role.RoleName', $this->roleId])
            ->andFilterWhere(['=', 'status', $this->status])
            ->andFilterWhere(['like', 'profileImage', $this->profileImage]);

        return $dataProvider;
    }
}
