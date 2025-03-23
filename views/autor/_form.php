<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Autor */
/* @var $form yii\widgets\ActiveForm */

$isAjax = Yii::$app->request->isAjax;
?>

<div class="autor-form">
    <?php $form = ActiveForm::begin([
        'options' => ['autocomplete' => 'off'],
    ]); ?>

    <div class="row">
        <div class="col-md-12 mb-3">
            <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'cpf')->textInput(['maxlength' => true, 'class' => 'form-control cpf']) ?>
        </div>

        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'data_nascimento')->input('date') ?>
        </div>

        <?php if (!$model->isNewRecord): ?>
            <div class="col-md-4 mb-3">
                <?= $form->field($model, 'status')->dropDownList([1 => 'Ativo', 0 => 'Inativo'], ['prompt' => 'Selecione...']) ?>
            </div>
        <?php endif; ?>
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