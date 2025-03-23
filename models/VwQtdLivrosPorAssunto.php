<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_qtd_livros_por_assunto".
 *
 * @property int $assunto_id
 * @property string $assunto
 * @property int $qtd_livros
 */
class VwQtdLivrosPorAssunto extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vw_qtd_livros_por_assunto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['qtd_livros'], 'default', 'value' => 0],
            [['assunto_id', 'qtd_livros'], 'integer'],
            [['assunto'], 'required'],
            [['assunto'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'assunto_id' => 'Assunto ID',
            'assunto' => 'Assunto',
            'qtd_livros' => 'Qtd Livros',
        ];
    }

}
