<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Assunto */

$this->title = 'Novo Assunto';
$this->params['breadcrumbs'][] = ['label' => 'Assuntos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$isAjax = Yii::$app->request->isAjax;
?>

<?php if ($isAjax): ?>
    <?= $this->render('_form', ['model' => $model]) ?>
<?php else: ?>
    <div class="assunto-create container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><?= Html::encode($this->title) ?></h5>
            </div>
            <div class="card-body">
                <?= $this->render('_form', ['model' => $model]) ?>
            </div>
        </div>
    </div>
<?php endif; ?>