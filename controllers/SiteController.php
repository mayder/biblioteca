<?php

namespace app\controllers;

use app\models\Assunto;
use app\models\Autor;
use app\models\Editora;
use app\models\Livro;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\VwLivrosPorAnoPublicacao;
use app\models\VwLivrosPorSituacao;
use app\models\VwQtdLivrosPorAssunto;
use app\models\VwQtdLivrosPorAutor;
use app\models\VwValorTotalPorEditora;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $totalLivros = Livro::find()->count();
        $totalAutores = Autor::find()->count();
        $totalEditoras = Editora::find()->count();
        $totalAssuntos = Assunto::find()->count();

        $livrosPorAutor = VwQtdLivrosPorAutor::find()->asArray()->all();
        $livrosPorSituacao = VwLivrosPorSituacao::find()->asArray()->all();
        $livrosPorAssunto = VwQtdLivrosPorAssunto::find()->asArray()->all();
        $valorPorEditora = VwValorTotalPorEditora::find()->asArray()->all();
        $livrosPorAno = VwLivrosPorAnoPublicacao::find()->asArray()->all();

        return $this->render('index', [
            'totalLivros' => $totalLivros,
            'totalAutores' => $totalAutores,
            'totalEditoras' => $totalEditoras,
            'totalAssuntos' => $totalAssuntos,

            'livrosPorAno' => $livrosPorAno,
            'livrosPorSituacao' => $livrosPorSituacao,
            'livrosPorAssunto' => $livrosPorAssunto,
            'livrosPorAutor' => $livrosPorAutor,
            'valorPorEditora' => $valorPorEditora,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionDesafio()
    {
        return $this->render('desafio');
    }
}
