<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_valor_total_por_editora".
 *
 * @property int $editora_id
 * @property string $razao_social
 * @property float|null $valor_total
 */
class VwValorTotalPorEditora extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vw_valor_total_por_editora';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valor_total'], 'default', 'value' => null],
            [['editora_id'], 'default', 'value' => 0],
            [['editora_id'], 'integer'],
            [['razao_social'], 'required'],
            [['valor_total'], 'number'],
            [['razao_social'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'editora_id' => 'Editora ID',
            'razao_social' => 'Razao Social',
            'valor_total' => 'Valor Total',
        ];
    }

}
