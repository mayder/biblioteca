<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "livro_assunto".
 *
 * @property int $livro_id
 * @property int $assunto_id
 * @property int $status
 * @property string $data_cadastro
 * @property string $data_alteracao
 *
 * @property Assunto $assunto
 * @property Livro $livro
 */
class LivroAssunto extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'livro_assunto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'default', 'value' => 1],
            [['livro_id', 'assunto_id'], 'required'],
            [['livro_id', 'assunto_id', 'status'], 'integer'],
            [['data_cadastro', 'data_alteracao'], 'safe'],
            [['livro_id', 'assunto_id'], 'unique', 'targetAttribute' => ['livro_id', 'assunto_id']],
            [['assunto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Assunto::class, 'targetAttribute' => ['assunto_id' => 'id']],
            [['livro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Livro::class, 'targetAttribute' => ['livro_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'livro_id' => 'Livro',
            'assunto_id' => 'Assunto',
            'status' => 'Status',
            'data_cadastro' => 'Cadastrado em',
            'data_alteracao' => 'Última alteração em',
        ];
    }

    /**
     * Gets query for [[Assunto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssunto()
    {
        return $this->hasOne(Assunto::class, ['id' => 'assunto_id']);
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
}
