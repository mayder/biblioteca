<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Autor */

$isModal = Yii::$app->request->isAjax;
?>

<?php if (!$isModal): ?>
    <div class="container-fluid py-3">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fa fa-info-circle"></i> Detalhes do Autor
                </h5>
            </div>
            <div class="card-body">
            <?php endif; ?>

            <?= DetailView::widget([
                'model' => $model,
                'options' => ['class' => 'table table-striped table-bordered detail-view'],
                'attributes' => [
                    //'id',
                    //'uuid',
                    'nome',
                    [
                        'attribute' => 'cpf',
                        'value' => function ($model) {
                            return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $model->cpf);
                        }
                    ],
                    [
                        'attribute' => 'data_nascimento',
                        'format' => ['date', 'php:d/m/Y'],
                        'label' => 'Nascimento',
                    ],
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => $model->status
                            ? '<span class="badge bg-success">Ativo</span>'
                            : '<span class="badge bg-secondary">Inativo</span>',
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

            <?php if (!$isModal): ?>
            </div>
        </div>
    </div>
<?php endif; ?>