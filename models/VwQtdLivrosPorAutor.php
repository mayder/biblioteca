<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_qtd_livros_por_autor".
 *
 * @property int $autor_id
 * @property string $autor_nome
 * @property int $qtd_livros
 */
class VwQtdLivrosPorAutor extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vw_qtd_livros_por_autor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['qtd_livros'], 'default', 'value' => 0],
            [['autor_id', 'qtd_livros'], 'integer'],
            [['autor_nome'], 'required'],
            [['autor_nome'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'autor_id' => 'Autor ID',
            'autor_nome' => 'Autor Nome',
            'qtd_livros' => 'Qtd Livros',
        ];
    }

}
