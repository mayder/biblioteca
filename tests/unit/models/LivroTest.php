<?php

namespace tests\unit\models;

use yii\web\Application;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../../../config/test.php';
new Application($config);

use app\models\Livro;
use Yii;
use PHPUnit\Framework\TestCase;

class LivroTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Yii::$app->db->open(); // Garante que a conexão está aberta
    }

    public function testLivroValidation()
    {
        $livro = new Livro();
        $this->assertFalse($livro->validate(), 'Validação deve falhar com dados vazios');

        $livro->titulo = 'Livro Teste';
        $livro->editora_id = 1;
        $livro->situacao_id = 1;
        $livro->edicao = 1;
        $livro->ano_publicacao = '2025';

        $this->assertTrue($livro->validate(), 'Validação deve passar com dados obrigatórios preenchidos');
    }

    public function testLivroCriacaoComRelacionamento()
    {
        $livro = new Livro([
            'titulo' => 'Livro TDD',
            'editora_id' => 1,
            'situacao_id' => 1,
            'edicao' => 2,
            'ano_publicacao' => '2025',
            'valor_recomendado' => '19,90',
            'data_cadastro' => date('Y-m-d H:i:s'),
            'data_alteracao' => date('Y-m-d H:i:s'),
            'assunto_ids' => [1, 2],
        ]);

        $this->assertTrue($livro->save(), 'Livro deve ser salvo com sucesso');
        $this->assertIsInt($livro->id, 'Livro salvo deve ter um ID');
        $this->assertEquals('Livro TDD', $livro->titulo);

        $assuntos = $livro->getAssuntos()->count();
        $this->assertEquals(2, $assuntos, 'Livro deve estar relacionado com 2 assuntos');
    }

    public function testLivroValorRecomendadoConversao()
    {
        $livro = new Livro([
            'titulo' => 'Teste Valor',
            'editora_id' => 1,
            'situacao_id' => 1,
            'edicao' => 1,
            'ano_publicacao' => '2025',
            'valor_recomendado' => '29,99',
            'data_cadastro' => date('Y-m-d H:i:s'),
            'data_alteracao' => date('Y-m-d H:i:s'),
        ]);

        $livro->beforeValidate();
        $this->assertEquals(29.99, $livro->valor_recomendado);
    }
}
