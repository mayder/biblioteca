<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "livro_autor".
 *
 * @property int $livro_id
 * @property int $autor_id
 * @property int $tipo_autor_id
 * @property int $status
 * @property string $data_cadastro
 * @property string $data_alteracao
 *
 * @property Autor $autor
 * @property Livro $livro
 * @property TipoAutor $tipoAutor
 */
class LivroAutor extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'livro_autor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'default', 'value' => 1],
            [['livro_id', 'autor_id', 'tipo_autor_id'], 'required'],
            [['livro_id', 'autor_id', 'tipo_autor_id', 'status'], 'integer'],
            [['data_cadastro', 'data_alteracao'], 'safe'],
            [['livro_id', 'autor_id'], 'unique', 'targetAttribute' => ['livro_id', 'autor_id']],
            [['autor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Autor::class, 'targetAttribute' => ['autor_id' => 'id']],
            [['livro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Livro::class, 'targetAttribute' => ['livro_id' => 'id']],
            [['tipo_autor_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoAutor::class, 'targetAttribute' => ['tipo_autor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'livro_id' => 'Livro',
            'autor_id' => 'Autor',
            'tipo_autor_id' => 'Tipo de vínculo',
            'status' => 'Status',
            'data_cadastro' => 'Cadastrado em',
            'data_alteracao' => 'Última alteração em',
        ];
    }

    /**
     * Gets query for [[Autor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAutor()
    {
        return $this->hasOne(Autor::class, ['id' => 'autor_id']);
    }

    /**
     * Gets query for [[Livro]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLivro()
    {
        return $this->hasOne(Livro::class, ['id' => 'livro_id']);
    }

    /**
     * Gets query for [[TipoAutor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoAutor()
    {
        return $this->hasOne(TipoAutor::class, ['id' => 'tipo_autor_id']);
    }
}
