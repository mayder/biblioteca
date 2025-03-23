<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_autor".
 *
 * @property int $id
 * @property string $descricao
 *
 * @property LivroAutor[] $livroAutors
 */
class TipoAutor extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_autor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao'], 'required'],
            [['descricao'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descrição',
        ];
    }

    /**
     * Gets query for [[LivroAutors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLivroAutors()
    {
        return $this->hasMany(LivroAutor::class, ['tipo_autor_id' => 'id']);
    }
}
