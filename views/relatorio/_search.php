<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\Editora;
use app\models\Situacao;
use app\models\Autor;

/** @var yii\web\View $this */
/** @var app\models\VwRelatorioLivrosAutoresSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="card mb-4 shadow-sm">
    <div class="card-header bg-light">
        <strong><i class="fa fa-filter"></i> Filtros do Relatório</strong>
    </div>

    <div class="card-body">
        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]); ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'livro_titulo') ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'edicao') ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'ano_publicacao')->widget(DatePicker::class, [
                    'options' => ['placeholder' => 'Ano de publicação...'],
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pluginOptions' => [
                        'format' => 'yyyy',
                        'minViewMode' => 2,
                        'autoclose' => true
                    ],
                ]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'valor_recomendado') ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'situacao_livro')->widget(Select2::class, [
                    'data' => ArrayHelper::map(Situacao::find()->all(), 'descricao', 'descricao'),
                    'options' => ['placeholder' => 'Situação...', 'multiple' => true],
                    'pluginOptions' => ['allowClear' => true],
                ]) ?>
            </div>
            <div class="col-md-5">
                <?= $form->field($model, 'editora_nome')->widget(Select2::class, [
                    'data' => ArrayHelper::map(Editora::find()->all(), 'razao_social', 'razao_social'),
                    'options' => ['placeholder' => 'Editora...', 'multiple' => true],
                    'pluginOptions' => ['allowClear' => true],
                ]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'editora_cnpj') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'editora_nome_fantasia') ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'autor_nome')->widget(Select2::class, [
                    'data' => ArrayHelper::map(Autor::find()->all(), 'nome', 'nome'),
                    'options' => ['placeholder' => 'Autor...', 'multiple' => true],
                    'pluginOptions' => ['allowClear' => true],
                ]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'autor_cpf') ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'data_nascimento')->widget(DatePicker::class, [
                    'options' => ['placeholder' => 'Nascimento...'],
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true
                    ],
                ]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'tipo_autor') ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'assuntos') ?>
            </div>
        </div>

        <div class="mt-3">
            <?= Html::submitButton('Filtrar', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Limpar', ['class' => 'btn btn-outline-secondary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>