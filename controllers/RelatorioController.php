<?php

namespace app\controllers;

use app\models\VwRelatorioLivrosAutoresSearch;
use yii\web\Controller;

/**
 * RelatorioController implements actions for VwRelatorioLivrosAutores model.
 */
class RelatorioController extends Controller
{
    /**
     * Lists all VwRelatorioLivrosAutores models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new VwRelatorioLivrosAutoresSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
