<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'titulo',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'situacao_id',
        'label' => 'Situação',
        'value' => function ($model) {
            return $model->situacao->descricao ?? '';
        },
        'filter' => \yii\helpers\ArrayHelper::map(\app\models\Situacao::find()->all(), 'id', 'descricao'),
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'editora_id',
        'label' => 'Editora',
        'value' => function ($model) {
            return $model->editora->razao_social ?? '';
        },
        'filter' => \yii\helpers\ArrayHelper::map(\app\models\Editora::find()->all(), 'id', 'razao_social'),
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'edicao',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'width' => '80px',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'ano_publicacao',
        'label' => 'Ano',
        'hAlign' => 'center',
        'width' => '80px',
    ],
    [
        'attribute' => 'valor_recomendado',
        'label' => 'Valor recomendado',
        'value' => function ($model) {
            return 'R$ ' . $model->valor_recomendado;
        },
        'hAlign' => 'right',
        'vAlign' => 'middle',
    ],
    [
        'header' => 'Última alteração',
        'format' => 'raw',
        'value' => function ($model) {
            return '<div class="small text-muted">'
                . Yii::$app->formatter->asDatetime($model->data_alteracao, 'php:d/m/Y H:i')
                . '</div>';
        },
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'filter' => false,
        'mergeHeader' => true,
        'width' => '180px',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'noWrap' => true,
        'template' => '{view} {autores} {update} {delete}',
        'vAlign' => 'middle',
        'urlCreator' => fn($action, $model, $key, $index) => Url::to([$action, 'id' => $key]),
        'buttons' => [
            'autores' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-users"></i>', ['autores', 'id' => $model->id], [
                    'title' => 'Autores',
                    'class' => 'btn btn-sm btn-outline-secondary',
                    'role' => 'modal-remote',
                    'data-bs-toggle' => 'tooltip',
                ]);
            },
        ],
        'viewOptions' => [
            'role' => 'modal-remote',
            'title' => Yii::t('yii2-ajaxcrud', 'View'),
            'class' => 'btn btn-sm btn-outline-success',
            'data-bs-toggle' => 'tooltip',
        ],
        'updateOptions' => [
            'role' => 'modal-remote',
            'title' => Yii::t('yii2-ajaxcrud', 'Update'),
            'class' => 'btn btn-sm btn-outline-primary',
            'data-bs-toggle' => 'tooltip',
        ],
        'deleteOptions' => [
            'role' => 'modal-remote',
            'title' => Yii::t('yii2-ajaxcrud', 'Delete'),
            'class' => 'btn btn-sm btn-outline-danger',
            'data-confirm' => false,
            'data-method' => false,
            'data-request-method' => 'post',
            'data-confirm-title' => Yii::t('yii2-ajaxcrud', 'Delete'),
            'data-confirm-message' => Yii::t('yii2-ajaxcrud', 'Delete Confirm'),
            'data-bs-toggle' => 'tooltip',
        ],
    ],
];
