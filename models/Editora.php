<?php

namespace app\models;

use Yii;
use app\traits\UuidTrait;

/**
 * This is the model class for table "editora".
 *
 * @property int $id
 * @property string $uuid
 * @property string $razao_social
 * @property string $cnpj
 * @property string|null $nome_fantasia
 * @property int $status
 * @property string $data_cadastro
 * @property string $data_alteracao
 *
 * @property Livro[] $livros
 */
class Editora extends \yii\db\ActiveRecord
{
    use UuidTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'editora';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome_fantasia'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 1],
            [['uuid', 'razao_social', 'cnpj'], 'required'],
            [['status'], 'integer'],
            [['data_cadastro', 'data_alteracao'], 'safe'],
            [['uuid'], 'string', 'max' => 36],
            [['razao_social'], 'string', 'max' => 100],
            [['cnpj'], 'string', 'max' => 18],
            [['nome_fantasia'], 'string', 'max' => 45],
            [['uuid'], 'unique'],
            ['cnpj', 'validarCnpj'],
        ];
    }

    public function validarCnpj($attribute)
    {
        $cnpj = preg_replace('/[^0-9]/', '', $this->$attribute);
        if (strlen($cnpj) !== 14 || preg_match('/(\d)\1{13}/', $cnpj)) {
            $this->addError($attribute, 'CNPJ inválido.');
            return;
        }
        for ($t = 12; $t < 14; $t++) {
            $d = 0;
            $c = 0;
            for ($m = $t - 7, $i = 0; $i < $t; $i++) {
                $d += $cnpj[$i] * $m--;
                if ($m < 2) $m = 9;
            }
            $r = ($d % 11 < 2) ? 0 : 11 - ($d % 11);
            if ($cnpj[$i] != $r) {
                $this->addError($attribute, 'CNPJ inválido.');
                return;
            }
        }
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $this->cnpj = preg_replace('/[^0-9]/', '', $this->cnpj);
        return true;
    }

    public function beforeValidate()
    {
        $this->generateUuidIfEmpty();
        return parent::beforeValidate();
    }
    public function afterFind()
    {
        parent::afterFind();

        if (!empty($this->cnpj)) {
            $this->cnpj = preg_replace('/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/', '$1.$2.$3/$4-$5', $this->cnpj);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uuid' => 'UUID',
            'razao_social' => 'Razao social',
            'cnpj' => 'CNPJ',
            'nome_fantasia' => 'Nome fantasia',
            'status' => 'Status',
            'data_cadastro' => 'Cadastrado em',
            'data_alteracao' => 'Última alteração em',
        ];
    }

    public function fields()
    {
        return [
            'id',
            'razao_social',
            'nome_fantasia',
            'cnpj',
            'status',
            // 'data_cadastro',
            // 'data_alteracao'
        ];
    }

    /**
     * Gets query for [[Livros]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLivros()
    {
        return $this->hasMany(Livro::class, ['editora_id' => 'id']);
    }
}
