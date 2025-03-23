<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Desafio Técnico';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container my-5">
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold text-primary">Desafio Técnico</h1>
        <p class="lead text-muted">Leia atentamente as instruções abaixo</p>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">Objetivo</div>
        <div class="card-body">
            <p>
                Criar um projeto utilizando as boas práticas de mercado e apresentar o mesmo demonstrando o passo a passo de sua criação
                (base de dados, tecnologias, aplicação, metodologias, frameworks, etc).
            </p>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">Projeto</div>
        <div class="card-body">
            <p>O projeto consiste em um cadastro de livros.</p>
            <p>No final deste documento foi disponibilizado um modelo dos dados.</p>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">Tecnologia</div>
        <div class="card-body">
            <p>
                A tecnologia a ser utilizada é sempre Web e referente à vaga em que está concorrendo. A implementação do projeto ficará
                por sua total responsabilidade assim como os componentes a serem utilizados (relatórios, camada de persistência, etc)
                com algumas premissas:
            </p>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">O banco de dados é o de sua preferência.</li>
                <li class="list-group-item">A utilização de camada de persistência também é escolha sua.</li>
            </ul>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">Instruções</div>
        <div class="card-body">
            <ul class="list-group list-group-numbered">
                <li class="list-group-item">Deve ser feito CRUD para Livro, Autor e Assunto conforme o modelo de dados.</li>
                <li class="list-group-item">A tela inicial pode ter um menu simples ou mesmo links direto para as telas construídas.</li>
                <li class="list-group-item">O modelo do banco deve ser seguido integralmente, salvo para ajustes de melhoria de performance.</li>
                <li class="list-group-item">A interface pode ser simples, mas precisa utilizar algum CSS que comande no mínimo a cor e tamanho dos componentes em tela (utilização do Bootstrap será um diferencial).</li>
                <li class="list-group-item">Os campos que pedem formatação devem possuir o mesmo (data, moeda, etc).</li>
                <li class="list-group-item">Deve ser feito obrigatoriamente um relatório (utilizando o componente de relatórios de sua preferência (Crystal, ReportViewer, etc)) e a consulta desse relatório deve ser proveniente de uma view criada no banco de dados.</li>
                <li class="list-group-item">O relatório pode ser simples, mas permita o entendimento dos dados. O relatório deve trazer as informações das 3 tabelas principais agrupando os dados por autor (atenção pois um livro pode ter mais de um autor).</li>
                <li class="list-group-item">TDD (Test Driven Development) será considerado um diferencial.</li>
                <li class="list-group-item">Tratamento de erros é essencial. Evite try/catchs genéricos em situações que permitam utilização de tratamentos específicos, como os possíveis erros de banco de dados.</li>
                <li class="list-group-item">As mensagens emitidas pelo sistema, labels e etc. ficam a seu critério.</li>
                <li class="list-group-item">O modelo inicial não prevê, mas é necessário incluir um campo de valor (R$) para o livro.</li>
                <li class="list-group-item">Guarde todos os scripts e instruções para implantação de seu projeto, eles devem ser demonstrados na apresentação.</li>
            </ul>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">Apresentação</div>
        <div class="card-body">
            <p>
                O teste deve ser apresentado na entrevista técnica que será agendada. A ideia é discutir seu projeto, avaliar o mesmo
                funcionalmente e tecnicamente.
            </p>
        </div>
    </div>

    <div class="card mb-5 shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">Modelo</div>
        <div class="card-body text-center">
            <p class="mb-3">Veja abaixo a imagem do modelo de dados enviado no desafio:</p>
            <img src="<?= Yii::$app->request->baseUrl ?>/images/modelo_proposto.png" alt="Modelo do banco de dados" class="img-fluid border rounded">
        </div>
    </div>

    <div class="alert alert-info text-center">
        <?= Html::a('Voltar para o início', ['site/index'], ['class' => 'btn btn-outline-primary']) ?>
    </div>
</div>