<?php

namespace app\models;

use Yii;
use app\traits\UuidTrait;

/**
 * This is the model class for table "assunto".
 *
 * @property int $id
 * @property string $uuid
 * @property string $descricao
 * @property string|null $sigla
 * @property int $status
 * @property string $data_cadastro
 * @property string $data_alteracao
 *
 * @property LivroAssunto[] $livroAssuntos
 * @property Livro[] $livros
 */
class Assunto extends \yii\db\ActiveRecord
{
    use UuidTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assunto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sigla'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 1],
            [['uuid', 'descricao'], 'required'],
            [['status'], 'integer'],
            [['data_cadastro', 'data_alteracao'], 'safe'],
            [['uuid'], 'string', 'max' => 36],
            [['descricao'], 'string', 'max' => 45],
            [['sigla'], 'string', 'max' => 20],
            [['uuid'], 'unique'],
        ];
    }

    public function beforeValidate()
    {
        $this->generateUuidIfEmpty();
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
            'descricao' => 'Descrição',
            'sigla' => 'Sigla',
            'status' => 'Status',
            'data_cadastro' => 'Cadastrado em',
            'data_alteracao' => 'Última alteração em',
        ];
    }

    /**
     * Gets query for [[LivroAssuntos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLivroAssuntos()
    {
        return $this->hasMany(LivroAssunto::class, ['assunto_id' => 'id']);
    }

    /**
     * Gets query for [[Livros]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLivros()
    {
        return $this->hasMany(Livro::class, ['id' => 'livro_id'])->viaTable('livro_assunto', ['assunto_id' => 'id']);
    }
}
