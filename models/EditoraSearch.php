<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Editora;

/**
 * EditoraSearch represents the model behind the search form about `app\models\Editora`.
 */
class EditoraSearch extends Editora
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['uuid', 'razao_social', 'cnpj', 'nome_fantasia', 'status', 'data_cadastro', 'data_alteracao'], 'safe'],
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
        $query = Editora::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $cnpj = $this->cnpj;
        if (isset($this->cnpj)) {
            $cnpj = preg_replace('/[^0-9]/', '', $this->cnpj);
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'data_cadastro' => $this->data_cadastro,
            'data_alteracao' => $this->data_alteracao,
        ]);

        $query
            // ->andFilterWhere(['like', 'uuid', $this->uuid])
            ->andFilterWhere(['like', 'razao_social', $this->razao_social])
            ->andFilterWhere(['like', 'cnpj', $cnpj])
            ->andFilterWhere(['like', 'nome_fantasia', $this->nome_fantasia])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
