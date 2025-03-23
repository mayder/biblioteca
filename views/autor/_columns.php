<?php

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
        'attribute' => 'nome',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'cpf',
        'hAlign' => 'center',
        'vAlign' => 'middle',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'data_nascimento',
        'format' => ['date', 'php:d/m/Y'],
        'hAlign' => 'center',
        'vAlign' => 'middle',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'status',
        'format' => 'raw',
        'hAlign' => 'center',
        'value' => fn($model) => $model->status
            ? '<span class="badge bg-success">Ativo</span>'
            : '<span class="badge bg-secondary">Inativo</span>',
        'filter' => [1 => 'Ativo', 0 => 'Inativo'],
    ],
    [
        'header' => 'Última atualização',
        'format' => 'raw',
        'attribute' => false,
        'value' => fn($model) => '<div class="small text-muted"><strong>' .
            Yii::$app->formatter->asDatetime($model->data_alteracao, 'php:d/m/Y H:i') .
            '</strong></div>',
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'filter' => false,
        'mergeHeader' => true,
        'width' => '200px',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'noWrap' => true,
        'template' => '{view} {update} {delete}',
        'vAlign' => 'middle',
        'urlCreator' => fn($action, $model, $key, $index) => Url::to([$action, 'id' => $key]),
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
