<?php

namespace app\models;

use Yii;
use app\traits\UuidTrait;

/**
 * This is the model class for table "autor".
 *
 * @property int $id
 * @property string $uuid
 * @property string $nome
 * @property string $cpf
 * @property string|null $data_nascimento
 * @property int $status
 * @property string $data_cadastro
 * @property string $data_alteracao
 *
 * @property LivroAutor[] $livroAutors
 * @property Livro[] $livros
 */
class Autor extends \yii\db\ActiveRecord
{
    use UuidTrait;

    public static function tableName()
    {
        return 'autor';
    }

    public function rules()
    {
        return [
            [['data_nascimento'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 1],
            [['uuid', 'nome', 'cpf'], 'required'],
            [['data_nascimento', 'data_cadastro', 'data_alteracao'], 'safe'],
            [['status'], 'integer'],
            [['uuid'], 'string', 'max' => 36],
            [['nome'], 'string', 'max' => 100],
            [['cpf'], 'string', 'max' => 14],
            [['uuid'], 'unique'],
            ['cpf', 'validarCpf'],
        ];
    }

    public function validarCpf($attribute)
    {
        $cpf = preg_replace('/[^0-9]/', '', $this->$attribute);
        if (strlen($cpf) !== 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            $this->addError($attribute, 'CPF inválido.');
            return;
        }

        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $r = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $r) {
                $this->addError($attribute, 'CPF inválido.');
                return;
            }
        }
    }

    public function beforeValidate()
    {
        $this->generateUuidIfEmpty();
        return parent::beforeValidate();
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->cpf = preg_replace('/[^0-9]/', '', $this->cpf);
        return true;
    }

    public function afterFind()
    {
        parent::afterFind();
        if (!empty($this->cpf)) {
            $this->cpf = preg_replace('/^(\d{3})(\d{3})(\d{3})(\d{2})$/', '$1.$2.$3-$4', $this->cpf);
        }
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uuid' => 'UUID',
            'nome' => 'Nome',
            'cpf' => 'CPF',
            'data_nascimento' => 'Data de nascimento',
            'status' => 'Status',
            'data_cadastro' => 'Cadastrado em',
            'data_alteracao' => 'Última alteração em',
        ];
    }

    public function fields()
    {
        return [
            'id',
            'nome',
            'cpf',
            'data_nascimento' => function () {
                return Yii::$app->formatter->asDate($this->data_nascimento, 'php:d/m/Y');
            },
            'status',
            // 'data_cadastro',
            // 'data_alteracao'
        ];
    }

    public function getLivroAutors()
    {
        return $this->hasMany(LivroAutor::class, ['autor_id' => 'id']);
    }

    public function getLivros()
    {
        return $this->hasMany(Livro::class, ['id' => 'livro_id'])->viaTable('livro_autor', ['autor_id' => 'id']);
    }
}
