<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use app\models\Autor;
use app\models\TipoAutor;
use yii\helpers\ArrayHelper;

/** @var $this yii\web\View */
/** @var $model app\models\Livro */
/** @var $livroAutores app\models\LivroAutor[] */
/** @var $novoLivroAutor app\models\LivroAutor */

$isAjax = Yii::$app->request->isAjax;
?>

<?php if (!$isAjax): ?>
    <div class="container-fluid py-3">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fa fa-user-plus"></i> Autores do Livro: <?= Html::encode($model->titulo) ?></h5>
            </div>
            <div class="card-body">
            <?php endif; ?>

            <div class="livro-autores-form mb-4">
                <?php $form = ActiveForm::begin(); ?>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <?= $form->field($novoLivroAutor, 'autor_id')->widget(Select2::class, [
                            'data' => ArrayHelper::map(Autor::find()->where(['status' => 1])->orderBy('nome')->all(), 'id', 'nome'),
                            'options' => ['placeholder' => 'Selecione o autor...'],
                            'pluginOptions' => ['allowClear' => true],
                        ]) ?>
                    </div>
                    <div class="col-md-6 mb-3">
                        <?= $form->field($novoLivroAutor, 'tipo_autor_id')->widget(Select2::class, [
                            'data' => ArrayHelper::map(TipoAutor::find()->orderBy('descricao')->all(), 'id', 'descricao'),
                            'options' => ['placeholder' => 'Selecione o tipo...'],
                            'pluginOptions' => ['allowClear' => true],
                        ]) ?>
                    </div>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Vincular Autor', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <?php if (!$isAjax): ?>
            </div>
        </div>
    </div>
<?php endif; ?>