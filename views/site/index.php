<?php

$this->title = 'Dashboard';

// Prepara os dados para o JavaScript
$labelsAutor = array_column($livrosPorAutor, 'nome');
$dataAutor = array_column($livrosPorAutor, 'quantidade');

$labelsSituacao = array_column($livrosPorSituacao, 'descricao');
$dataSituacao = array_column($livrosPorSituacao, 'quantidade');
?>

<div class="container-fluid py-4 dashboard">
    <div class="row mb-4 text-center">
        <div class="col">
            <h2 class="fw-bold">📚 Biblioteca Digital - Painel Geral</h2>
            <p class="text-muted">Visão geral do sistema com base nos dados cadastrados</p>
        </div>
    </div>

    <div class="row text-center mb-4">
        <?php foreach (
            [
                ['Total de Livros', $totalLivros, 'primary'],
                ['Total de Autores', $totalAutores, 'success'],
                ['Total de Editoras', $totalEditoras, 'warning'],
                ['Total de Assuntos', $totalAssuntos, 'danger'],
            ] as [$titulo, $valor, $cor]
        ): ?>
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body border-start border-4 border-<?= $cor ?> d-flex flex-column align-items-center justify-content-center" style="min-height: 120px;">
                        <h5 class="card-title"><?= $titulo ?></h5>
                        <p class="display-6 mb-0"><?= $valor ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <strong><i class="fa fa-chart-bar"></i> Livros por Autor</strong>
                </div>
                <div class="card-body">
                    <canvas id="chartAutor"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <strong><i class="fa fa-book"></i> Livros por Situação</strong>
                </div>
                <div class="card-body">
                    <canvas id="chartSituacao"></canvas>
                </div>
            </div>
        </div>

    </div>
    <div class="row mb-4">

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <strong><i class="fa fa-tags"></i> Livros por Assunto</strong>
                </div>
                <div class="card-body">
                    <canvas id="chartAssunto"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <strong><i class="fa fa-coins"></i> Valor Total de Livros por Editora</strong>
                </div>
                <div class="card-body">
                    <canvas id="chartEditora"></canvas>
                </div>
            </div>
        </div>

    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <strong><i class="fa fa-calendar-alt"></i> Livros por Ano de Publicação</strong>
                </div>
                <div class="card-body">
                    <canvas id="chartAno"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<?php

$this->registerJsFile('https://cdn.jsdelivr.net/npm/chart.js', ['position' => \yii\web\View::POS_END]);

$labelsAutor = json_encode(array_column($livrosPorAutor, 'autor_nome'), JSON_UNESCAPED_UNICODE);
$dataAutor = json_encode(array_map('floatval', array_column($livrosPorAutor, 'qtd_livros')));

$this->registerJs("
const ctxAutor = document.getElementById('chartAutor').getContext('2d');
new Chart(ctxAutor, {
    type: 'bar',
    data: {
        labels: $labelsAutor,
        datasets: [{
            label: 'Livros',
            data: $dataAutor,
            backgroundColor: '#0d6efd'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
        },
        scales: {
            y: {
                beginAtZero: true,
                precision: 0
            }
        }
    }
});
");

$labelsSituacao = json_encode(array_column($livrosPorSituacao, 'situacao'), JSON_UNESCAPED_UNICODE);
$dataSituacao = json_encode(array_map('floatval', array_column($livrosPorSituacao, 'qtd_livros')));

$this->registerJs("
const ctxSituacao = document.getElementById('chartSituacao').getContext('2d');
new Chart(ctxSituacao, {
    type: 'pie',
    data: {
        labels: $labelsSituacao,
        datasets: [{
            label: 'Situação',
            data: $dataSituacao,
            backgroundColor: ['#ffc107', '#0dcaf0', '#198754', '#dc3545', '#6f42c1']
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
");

$labelsAssunto = json_encode(array_column($livrosPorAssunto, 'assunto'), JSON_UNESCAPED_UNICODE);
$dataAssunto = json_encode(array_map('intval', array_column($livrosPorAssunto, 'qtd_livros')));

$this->registerJs("
const ctxAssunto = document.getElementById('chartAssunto').getContext('2d');
new Chart(ctxAssunto, {
    type: 'bar',
    data: {
        labels: $labelsAssunto,
        datasets: [{
            label: 'Quantidade de Livros',
            data: $dataAssunto,
            backgroundColor: '#0dcaf0'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
        },
        scales: {
            y: {
                beginAtZero: true,
                precision: 0
            }
        }
    }
});
");

$labelsEditora = json_encode(array_column($valorPorEditora, 'razao_social'), JSON_UNESCAPED_UNICODE);
$dataEditora = json_encode(array_map('floatval', array_column($valorPorEditora, 'valor_total')));

$this->registerJs("
const ctxEditora = document.getElementById('chartEditora').getContext('2d');
new Chart(ctxEditora, {
    type: 'bar',
    data: {
        labels: $labelsEditora,
        datasets: [{
            label: 'Valor Total (R$)',
            data: $dataEditora,
            backgroundColor: '#ffc107'
        }]
    },
    options: {
        responsive: true,
        indexAxis: 'y',
        plugins: {
            legend: { display: false },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return 'R$ ' + context.raw.toLocaleString('pt-BR', {minimumFractionDigits: 2});
                    }
                }
            }
        },
        scales: {
            x: {
                beginAtZero: true
            }
        }
    }
});
");

$labelsAno = json_encode(array_column($livrosPorAno, 'ano_publicacao'));
$dataAno = json_encode(array_map('intval', array_column($livrosPorAno, 'qtd_livros')));

$this->registerJs("
const ctxAno = document.getElementById('chartAno');
if (ctxAno) {
    new Chart(ctxAno, {
        type: 'line',
        data: {
            labels: $labelsAno,
            datasets: [{
                label: 'Quantidade de Livros',
                data: $dataAno,
                fill: false,
                borderColor: '#0dcaf0',
                backgroundColor: '#0dcaf0',
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
}
");

?>