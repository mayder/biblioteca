<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;


/** @var yii\web\View $this */
/** @var app\models\VwRelatorioLivrosAutoresSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = '📊 Relatório';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fa fa-table me-2"></i><?= Html::encode($this->title) ?></h5>
        </div>

        <div class="card-body">
            <?= $this->render('_search', ['model' => $searchModel]) ?>

            <div class="text-end">
                <?= ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['attribute' => 'livro_id', 'label' => 'ID do Livro'],
                        ['attribute' => 'livro_titulo', 'label' => 'Título'],
                        ['attribute' => 'edicao', 'label' => 'Nº Edição'],
                        ['attribute' => 'ano_publicacao', 'label' => 'Ano de Publicação'],
                        [
                            'attribute' => 'valor_recomendado',
                            'label' => 'Valor Recomendado',
                            'value' => fn($model) => 'R$ ' . number_format($model->valor_recomendado, 2, ',', '.')
                        ],
                        ['attribute' => 'situacao_livro', 'label' => 'Situação'],
                        ['attribute' => 'editora_nome', 'label' => 'Editora'],
                        [
                            'attribute' => 'editora_cnpj',
                            'label' => 'CNPJ',
                            'value' => fn($model) => preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "$1.$2.$3/$4-$5", $model->editora_cnpj),
                        ],
                        ['attribute' => 'editora_nome_fantasia', 'label' => 'Nome Fantasia'],
                        ['attribute' => 'autor_id', 'label' => 'ID do Autor'],
                        ['attribute' => 'autor_nome', 'label' => 'Autor'],
                        [
                            'attribute' => 'autor_cpf',
                            'label' => 'CPF',
                            'value' => fn($model) => preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $model->autor_cpf),
                        ],
                        [
                            'attribute' => 'data_nascimento',
                            'label' => 'Data de Nascimento',
                            'value' => fn($model) => Yii::$app->formatter->asDate($model->data_nascimento, 'php:d/m/Y'),
                        ],
                        ['attribute' => 'tipo_autor', 'label' => 'Tipo de Autor'],
                        ['attribute' => 'assuntos', 'label' => 'Assuntos'],
                        [
                            'attribute' => 'livro_data_alteracao',
                            'label' => 'Última Alteração',
                        ],
                    ],
                    'filename' => 'relatorio_livros_autores',
                    'exportConfig' => [
                        ExportMenu::FORMAT_PDF => false, // Pode habilitar se quiser
                    ],
                    'dropdownOptions' => [
                        'label' => 'Exportar Relatório',
                        'class' => 'btn btn-outline-secondary'
                    ],
                    'columnSelectorOptions' => [
                        'label' => 'Colunas'
                    ]
                ]);
                ?>
            </div>

            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'tableOptions' => ['class' => 'table table-bordered table-striped table-hover align-middle'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'livro_titulo',
                        'edicao',
                        'ano_publicacao',
                        [
                            'attribute' => 'valor_recomendado',
                            'format' => ['currency'],
                        ],
                        'situacao_livro',
                        'editora_nome',
                        [
                            'attribute' => 'autor_nome',
                            'label' => 'Autor',
                        ],
                        'tipo_autor',
                        [
                            'attribute' => 'assuntos',
                            'format' => 'ntext',
                            'contentOptions' => ['style' => 'max-width: 300px; white-space: normal;'],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>