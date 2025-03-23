<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VwRelatorioLivrosAutores;

/**
 * VwRelatorioLivrosAutoresSearch represents the model behind the search form of `app\models\VwRelatorioLivrosAutores`.
 */
class VwRelatorioLivrosAutoresSearch extends VwRelatorioLivrosAutores
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['livro_id', 'edicao', 'autor_id'], 'integer'],
            [['livro_uuid', 'livro_titulo', 'ano_publicacao', 'livro_data_cadastro', 'livro_data_alteracao', 'situacao_livro', 'editora_nome', 'editora_cnpj', 'editora_nome_fantasia', 'autor_nome', 'autor_cpf', 'data_nascimento', 'tipo_autor', 'assuntos'], 'safe'],
            [['valor_recomendado'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = VwRelatorioLivrosAutores::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'livro_id' => $this->livro_id,
            'edicao' => $this->edicao,
            'ano_publicacao' => $this->ano_publicacao,
            'autor_id' => $this->autor_id,
        ]);

        if (!empty($this->valor_recomendado) && is_array($this->valor_recomendado)) {
            $query->andFilterWhere(['between', 'valor_recomendado', $this->valor_recomendado[0], $this->valor_recomendado[1]]);
        }

        if (!empty($this->livro_data_cadastro) && is_array($this->livro_data_cadastro)) {
            $query->andFilterWhere(['between', 'livro_data_cadastro', $this->livro_data_cadastro[0], $this->livro_data_cadastro[1]]);
        }

        if (!empty($this->data_nascimento) && is_array($this->data_nascimento)) {
            $query->andFilterWhere(['between', 'data_nascimento', $this->data_nascimento[0], $this->data_nascimento[1]]);
        }

        if (!empty($this->situacao_livro) && is_array($this->situacao_livro)) {
            $query->andFilterWhere(['in', 'situacao_livro', $this->situacao_livro]);
        }

        if (!empty($this->editora_nome) && is_array($this->editora_nome)) {
            $query->andFilterWhere(['in', 'editora_nome', $this->editora_nome]);
        }

        if (!empty($this->tipo_autor) && is_array($this->tipo_autor)) {
            $query->andFilterWhere(['in', 'tipo_autor', $this->tipo_autor]);
        }

        $query->andFilterWhere(['like', 'livro_titulo', $this->livro_titulo])
            ->andFilterWhere(['like', 'editora_cnpj', $this->editora_cnpj])
            ->andFilterWhere(['like', 'editora_nome_fantasia', $this->editora_nome_fantasia])
            ->andFilterWhere(['like', 'autor_nome', $this->autor_nome])
            ->andFilterWhere(['like', 'autor_cpf', $this->autor_cpf])
            ->andFilterWhere(['like', 'assuntos', $this->assuntos]);

        return $dataProvider;
    }
}
