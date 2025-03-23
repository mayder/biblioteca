<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_livros_por_ano_publicacao".
 *
 * @property string $ano_publicacao
 * @property int $qtd_livros
 */
class VwLivrosPorAnoPublicacao extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vw_livros_por_ano_publicacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['qtd_livros'], 'default', 'value' => 0],
            [['ano_publicacao'], 'required'],
            [['ano_publicacao'], 'safe'],
            [['qtd_livros'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ano_publicacao' => 'Ano Publicacao',
            'qtd_livros' => 'Qtd Livros',
        ];
    }

}
