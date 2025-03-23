<?php

namespace app\models;

use Yii;
use app\traits\UuidTrait;

/**
 * This is the model class for table "livro".
 *
 * @property int $id
 * @property string $uuid
 * @property string $titulo
 * @property int $situacao_id
 * @property int $editora_id
 * @property int $edicao
 * @property string $ano_publicacao
 * @property float|null $valor_recomendado
 * @property string $data_cadastro
 * @property string $data_alteracao
 *
 * @property Assunto[] $assuntos
 * @property Autor[] $autors
 * @property Editora $editora
 * @property LivroAssunto[] $livroAssuntos
 * @property LivroAutor[] $livroAutors
 * @property Situacao $situacao
 */
class Livro extends \yii\db\ActiveRecord
{
    use UuidTrait;
    public $assunto_ids = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'livro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valor_recomendado'], 'default', 'value' => null],
            [['uuid', 'titulo', 'situacao_id', 'editora_id', 'edicao', 'ano_publicacao'], 'required'],
            [['situacao_id', 'editora_id', 'edicao'], 'integer'],
            [['ano_publicacao', 'data_cadastro', 'data_alteracao'], 'safe'],
            [['valor_recomendado'], 'safe'],
            [['uuid'], 'string', 'max' => 36],
            [['titulo'], 'string', 'max' => 100],
            ['assunto_ids', 'each', 'rule' => ['integer']],
            [['uuid'], 'unique'],
            [['editora_id'], 'exist', 'skipOnError' => true, 'targetClass' => Editora::class, 'targetAttribute' => ['editora_id' => 'id']],
            [['situacao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Situacao::class, 'targetAttribute' => ['situacao_id' => 'id']],
        ];
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->assunto_ids = $this->getAssuntos()->select('id')->column();

        if ($this->valor_recomendado !== null) {
            $this->valor_recomendado = number_format($this->valor_recomendado, 2, ',', '.');
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        \app\models\LivroAssunto::deleteAll(['livro_id' => $this->id]);

        if (is_array($this->assunto_ids)) {
            foreach ($this->assunto_ids as $assuntoId) {
                $rel = new \app\models\LivroAssunto();
                $rel->livro_id = $this->id;
                $rel->assunto_id = $assuntoId;
                $rel->status = 1;
                $rel->data_cadastro = date('Y-m-d H:i:s');
                $rel->data_alteracao = date('Y-m-d H:i:s');
                $rel->save();
            }
        }
    }

    public function beforeValidate()
    {
        $this->generateUuidIfEmpty();

        if (!empty($this->valor_recomendado)) {
            $valor = str_replace(['R$', ' '], '', $this->valor_recomendado);
            $this->valor_recomendado = str_replace(',', '.', str_replace('.', '', $valor));
        }

        return parent::beforeValidate();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uuid' => 'UUID',
            'titulo' => 'Título',
            'situacao_id' => 'Situação',
            'editora_id' => 'Editora',
            'edicao' => 'Edição',
            'ano_publicacao' => 'Ano publicação',
            'valor_recomendado' => 'Valor recomendado',
            'data_cadastro' => 'Cadastrado em',
            'data_alteracao' => 'Última alteração em',
            'assunto_ids' => 'Assuntos',
        ];
    }

    /**
     * Gets query for [[Assuntos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssuntos()
    {
        return $this->hasMany(Assunto::class, ['id' => 'assunto_id'])->viaTable('livro_assunto', ['livro_id' => 'id']);
    }

    /**
     * Gets query for [[Autors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAutors()
    {
        return $this->hasMany(Autor::class, ['id' => 'autor_id'])->viaTable('livro_autor', ['livro_id' => 'id']);
    }

    /**
     * Gets query for [[Editora]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEditora()
    {
        return $this->hasOne(Editora::class, ['id' => 'editora_id']);
    }

    /**
     * Gets query for [[LivroAssuntos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLivroAssuntos()
    {
        return $this->hasMany(LivroAssunto::class, ['livro_id' => 'id']);
    }

    /**
     * Gets query for [[LivroAutors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLivroAutors()
    {
        return $this->hasMany(LivroAutor::class, ['livro_id' => 'id']);
    }

    /**
     * Gets query for [[Situacao]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSituacao()
    {
        return $this->hasOne(Situacao::class, ['id' => 'situacao_id']);
    }
}
