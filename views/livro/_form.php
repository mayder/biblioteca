<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use app\models\Editora;
use app\models\Situacao;
use app\models\Assunto;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Livro */
/* @var $form yii\widgets\ActiveForm */

$isAjax = Yii::$app->request->isAjax;
?>

<div class="livro-form">
    <?php $form = ActiveForm::begin([
        'options' => ['autocomplete' => 'off'],
    ]); ?>

    <div class="row">
        <div class="col-md-12 mb-3">
            <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-12 mb-3">
            <?= $form->field($model, 'editora_id')->widget(Select2::class, [
                'data' => ArrayHelper::map(Editora::find()->where(['status' => 1])->orderBy('razao_social')->all(), 'id', 'razao_social'),
                'options' => ['placeholder' => 'Selecione uma editora...'],
                'pluginOptions' => ['allowClear' => true],
            ]) ?>
        </div>

        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'situacao_id')->widget(Select2::class, [
                'data' => ArrayHelper::map(Situacao::find()->orderBy('descricao')->all(), 'id', 'descricao'),
                'options' => ['placeholder' => 'Selecione a situação...'],
                'pluginOptions' => ['allowClear' => true],
            ]) ?>
        </div>

        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'edicao')->textInput() ?>
        </div>

        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'ano_publicacao')->widget(DatePicker::class, [
                'options' => ['placeholder' => 'Selecione o ano...'],
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy',
                    'minViewMode' => 2,
                ],
            ]) ?>
        </div>

        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'valor_recomendado')->textInput(['class' => 'form-control moeda']) ?>
        </div>

        <div class="col-md-12 mb-3">
            <?= $form->field($model, 'assunto_ids')->widget(Select2::class, [
                'data' => ArrayHelper::map(Assunto::find()->where(['status' => 1])->orderBy('descricao')->all(), 'id', 'descricao'),
                'options' => ['multiple' => true, 'placeholder' => 'Selecione os assuntos...'],
                'pluginOptions' => ['allowClear' => true],
            ]) ?>
        </div>

    </div>

    <?php if (!$isAjax): ?>
        <div class="form-group mt-3">
            <?= Html::submitButton(
                $model->isNewRecord ? 'Criar' : 'Atualizar',
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
            ) ?>
        </div>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>
</div>