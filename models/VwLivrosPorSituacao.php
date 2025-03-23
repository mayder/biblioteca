<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_livros_por_situacao".
 *
 * @property int $situacao_id
 * @property string $situacao
 * @property int $qtd_livros
 */
class VwLivrosPorSituacao extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vw_livros_por_situacao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['qtd_livros'], 'default', 'value' => 0],
            [['situacao_id', 'qtd_livros'], 'integer'],
            [['situacao'], 'required'],
            [['situacao'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'situacao_id' => 'Situacao ID',
            'situacao' => 'Situacao',
            'qtd_livros' => 'Qtd Livros',
        ];
    }

}
