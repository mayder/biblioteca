<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_relatorio_livros_autores".
 *
 * @property int|null $livro_id
 * @property string|null $livro_uuid
 * @property string|null $livro_titulo
 * @property int|null $edicao
 * @property string|null $ano_publicacao
 * @property float|null $valor_recomendado
 * @property string|null $livro_data_cadastro
 * @property string|null $livro_data_alteracao
 * @property string|null $situacao_livro
 * @property string|null $editora_nome
 * @property string|null $editora_cnpj
 * @property string|null $editora_nome_fantasia
 * @property int $autor_id
 * @property string $autor_nome
 * @property string $autor_cpf
 * @property string|null $data_nascimento
 * @property string|null $tipo_autor
 * @property string|null $assuntos
 */
class VwRelatorioLivrosAutores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vw_relatorio_livros_autores';
    }

    public static function primaryKey()
    {
        return ["livro_id"];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['livro_uuid', 'livro_titulo', 'edicao', 'ano_publicacao', 'valor_recomendado', 'livro_data_cadastro', 'livro_data_alteracao', 'situacao_livro', 'editora_nome', 'editora_cnpj', 'editora_nome_fantasia', 'data_nascimento', 'tipo_autor', 'assuntos'], 'default', 'value' => null],
            [['autor_id'], 'default', 'value' => 0],
            [['livro_id', 'edicao', 'autor_id'], 'integer'],
            [['ano_publicacao', 'data_nascimento'], 'safe'],
            [['valor_recomendado'], 'number'],
            [['autor_nome', 'autor_cpf'], 'required'],
            [['assuntos'], 'string'],
            [['livro_uuid'], 'string', 'max' => 36],
            [['livro_titulo', 'editora_nome', 'autor_nome'], 'string', 'max' => 100],
            [['livro_data_cadastro', 'livro_data_alteracao'], 'string', 'max' => 21],
            [['situacao_livro', 'editora_nome_fantasia', 'tipo_autor'], 'string', 'max' => 45],
            [['editora_cnpj'], 'string', 'max' => 14],
            [['autor_cpf'], 'string', 'max' => 11],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'livro_id' => 'ID do Livro',
            'livro_uuid' => 'UUID do Livro',
            'livro_titulo' => 'Título',
            'edicao' => 'Edição',
            'ano_publicacao' => 'Ano de Publicação',
            'valor_recomendado' => 'Valor Recomendado',
            'livro_data_cadastro' => 'Data de cadastro do livro',
            'livro_data_alteracao' => 'Última alteração no livro',
            'situacao_livro' => 'Situalçai',
            'editora_nome' => 'Editora',
            'editora_cnpj' => 'CNPJ da Editora',
            'editora_nome_fantasia' => 'Nome Fantasia',
            'autor_id' => 'ID do Autor',
            'autor_nome' => 'Autor',
            'autor_cpf' => 'CPF do Autor',
            'data_nascimento' => 'Data de Nascimento',
            'tipo_autor' => 'Tipo de Autor',
            'assuntos' => 'Assuntos',
        ];
    }
}
