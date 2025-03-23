<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Livro */

$isModal = Yii::$app->request->isAjax;
?>

<?php if (!$isModal): ?>
    <div class="container-fluid py-3">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fa fa-info-circle"></i> Detalhes do Livro
                </h5>
            </div>
            <div class="card-body">
            <?php endif; ?>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'titulo',
                    [
                        'attribute' => 'editora_id',
                        'label' => 'Editora',
                        'value' => $model->editora->razao_social ?? null,
                    ],
                    [
                        'attribute' => 'situacao_id',
                        'label' => 'Situação',
                        'value' => $model->situacao->descricao ?? null,
                    ],
                    'edicao',
                    'ano_publicacao',
                    [
                        'attribute' => 'valor_recomendado',
                        'value' => 'R$ ' . $model->valor_recomendado,
                    ],
                    [
                        'attribute' => 'data_cadastro',
                        'format' => ['datetime', 'php:d/m/Y H:i'],
                        'label' => 'Cadastrado em',
                    ],
                    [
                        'attribute' => 'data_alteracao',
                        'format' => ['datetime', 'php:d/m/Y H:i'],
                        'label' => 'Atualizado em',
                    ],
                ],
            ]) ?>

            <hr>

            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0">
                    <i class="fa fa-users"></i> Autores Vinculados
                </h6>
                <?= Html::a('<i class="fa fa-plus"></i> Adicionar Autor', ['autores', 'id' => $model->id], [
                    'class' => 'btn btn-sm btn-outline-primary',
                    'role' => 'modal-remote', // permite funcionar com AJAX
                    'data-bs-toggle' => 'tooltip',
                    'title' => 'Adicionar autor',
                ]) ?>
            </div>
            <ul class="list-group mb-3">
                <?php
                $temAutores = false;
                foreach ($model->livroAutors as $livroAutor):
                    if ($livroAutor->status == 1):
                        $temAutores = true;
                ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= Html::encode($livroAutor->autor->nome) ?>
                            <span class="badge bg-secondary"><?= Html::encode($livroAutor->tipoAutor->descricao ?? 'N/A') ?></span>
                            <?= Html::a('<i class="fa fa-trash"></i>', [
                                'livro/remover-autor',
                                'livro_id' => $livroAutor->livro_id,
                                'autor_id' => $livroAutor->autor_id
                            ], [
                                'class' => 'btn btn-sm btn-outline-danger',
                                'title' => 'Remover',
                                'data-method' => 'post',
                                'data-confirm' => 'Deseja remover este autor?',
                                'encode' => false,
                            ]) ?>
                        </li>
                    <?php
                    endif;
                endforeach;
                if (!$temAutores):
                    ?>
                    <li class="list-group-item text-muted fst-italic">Nenhum autor vinculado.</li>
                <?php endif; ?>
            </ul>

            <h6><i class="fa fa-tag"></i> Assuntos Relacionados</h6>
            <ul class="list-group">
                <?php
                $temAssuntos = false;
                foreach ($model->assuntos as $assunto):
                    if ($assunto->status == 1):
                        $temAssuntos = true;
                ?>
                        <li class="list-group-item"><?= Html::encode($assunto->descricao) ?></li>
                    <?php
                    endif;
                endforeach;
                if (!$temAssuntos):
                    ?>
                    <li class="list-group-item text-muted fst-italic">Nenhum assunto vinculado.</li>
                <?php endif; ?>
            </ul>

            <?php if (!$isModal): ?>
            </div>
        </div>
    </div>
<?php endif; ?>