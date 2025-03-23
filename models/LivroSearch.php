<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Livro;

/**
 * LivroSearch represents the model behind the search form about `app\models\Livro`.
 */
class LivroSearch extends Livro
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'situacao_id', 'editora_id', 'edicao'], 'integer'],
            [['uuid', 'titulo', 'ano_publicacao', 'data_cadastro', 'data_alteracao'], 'safe'],
            [['valor_recomendado'], 'number'],
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
        $query = Livro::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'situacao_id' => $this->situacao_id,
            'editora_id' => $this->editora_id,
            'edicao' => $this->edicao,
            'ano_publicacao' => $this->ano_publicacao,
            'valor_recomendado' => $this->valor_recomendado,
            'data_cadastro' => $this->data_cadastro,
            'data_alteracao' => $this->data_alteracao,
        ]);

        $query
            // ->andFilterWhere(['like', 'uuid', $this->uuid])
            ->andFilterWhere(['like', 'titulo', $this->titulo]);

        return $dataProvider;
    }
}
