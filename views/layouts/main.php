<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header id="header">
        <?php

        NavBar::begin([
            'brandLabel' => 'Biblioteca Digital',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark bg-primary shadow-sm fixed-top px-3'
            ],
        ]);

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
            'items' => [
                ['label' => 'Dashboard', 'url' => ['/site/index']],
                ['label' => 'Desafio', 'url' => ['/site/desafio']],
                ['label' => 'Livros', 'url' => ['/livro/index']],
                ['label' => 'Autores', 'url' => ['/autor/index']],
                !Yii::$app->user->isGuest ? ['label' => 'Editoras', 'url' => ['/editora/index']] : '',
                ['label' => 'Assuntos', 'url' => ['/assunto/index']],
                ['label' => 'Relatório', 'url' => ['/relatorio/index']],
            ],
        ]);

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ms-auto mb-2 mb-md-0'],
            'items' => [
                Yii::$app->user->isGuest
                    ? ['label' => 'Login', 'url' => ['/site/login']]
                    : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'], 'post', ['class' => 'd-inline'])
                    . Html::submitButton(
                        'Sair (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'nav-link btn btn-link text-white logout']
                    )
                    . Html::endForm()
                    . '</li>'
            ],
        ]);

        NavBar::end();
        ?>
    </header>

    <main id="main" class="flex-shrink-0" role="main">
        <div class="container">
            <?php if (!empty($this->params['breadcrumbs'])): ?>
                <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            <?php endif ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <footer id="footer" class="mt-auto py-4 bg-light border-top">
        <div class="container">
            <div class="row text-muted align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    &copy; <?= date('Y') ?> Desafio Técnico
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <span>Desenvolvido por</span> <a href="https://www.mayder.com.br/" target="_blank" class="text-decoration-none fw-semibold">Breno Mayder</a>
                </div>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>