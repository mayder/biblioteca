<?php

namespace app\controllers;

use Yii;
use app\models\Assunto;
use app\models\AssuntoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * AssuntoController implements the CRUD actions for Assunto model.
 */
class AssuntoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                    'bulkdelete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Assunto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AssuntoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Assunto model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Assunto #" . $id,
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => 'modal']) .
                    Html::a(Yii::t('yii2-ajaxcrud', 'Update'), ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Assunto model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Assunto();

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if ($request->isGet) {
                return [
                    'title' => Yii::t('yii2-ajaxcrud', 'Create New') . " Assunto",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' =>
                    Html::button(Yii::t('yii2-ajaxcrud', 'Close'), [
                        'class' => 'btn btn-secondary',
                        'data-bs-dismiss' => 'modal'
                    ]) .
                        Html::button(Yii::t('yii2-ajaxcrud', 'Save'), [
                            'class' => 'btn btn-primary',
                            'type' => 'submit'
                        ]),
                ];
            }

            if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => Yii::t('yii2-ajaxcrud', 'Create New') . " Assunto",
                    'content' => '<span class="text-success">Assunto criado com sucesso.</span>',
                    'footer' =>
                    Html::button(Yii::t('yii2-ajaxcrud', 'Close'), [
                        'class' => 'btn btn-secondary',
                        'data-bs-dismiss' => 'modal'
                    ]) .
                        Html::a(Yii::t('yii2-ajaxcrud', 'Create More'), ['create'], [
                            'class' => 'btn btn-primary',
                            'role' => 'modal-remote'
                        ]),
                ];
            }

            return [
                'title' => Yii::t('yii2-ajaxcrud', 'Create New') . " Assunto",
                'content' => $this->renderAjax('create', [
                    'model' => $model,
                ]),
                'footer' =>
                Html::button(Yii::t('yii2-ajaxcrud', 'Close'), [
                    'class' => 'btn btn-secondary',
                    'data-bs-dismiss' => 'modal'
                ]) .
                    Html::button(Yii::t('yii2-ajaxcrud', 'Save'), [
                        'class' => 'btn btn-primary',
                        'type' => 'submit'
                    ]),
            ];
        }

        // Requisição normal (não-AJAX)
        if ($model->load($request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Assunto model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => Yii::t('yii2-ajaxcrud', 'Update') . " Assunto #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => 'modal']) .
                        Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class' => 'btn btn-primary', 'type' => 'submit'])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Assunto #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => 'modal']) .
                        Html::a(Yii::t('yii2-ajaxcrud', 'Update'), ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => Yii::t('yii2-ajaxcrud', 'Update') . " Assunto #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-bs-dismiss' => 'modal']) .
                        Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class' => 'btn btn-primary', 'type' => 'submit'])
                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Assunto model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;

        try {
            $this->findModel($id)->delete();

            if ($request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'forceClose' => true,
                    'forceReload' => '#crud-datatable-pjax',
                    'message' => ['type' => 'success', 'text' => 'Registro excluído com sucesso!']
                ];
            }

            Yii::$app->session->setFlash('success', 'Registro excluído com sucesso!');
            return $this->redirect(['index']);
        } catch (\yii\db\IntegrityException $e) {
            if ($request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'forceClose' => true,
                    'forceReload' => '#crud-datatable-pjax',
                    'message' => ['type' => 'error', 'text' => 'Este registro está relacionado e não pode ser excluído.']
                ];
            }

            Yii::$app->session->setFlash('error', 'Este registro está relacionado e não pode ser excluído.');
            return $this->redirect(['index']);
        }
    }

    /**
     * Delete multiple existing Assunto model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks'));
        $erros = 0;

        foreach ($pks as $pk) {
            try {
                $model = $this->findModel($pk);
                $model->delete();
            } catch (\yii\db\IntegrityException $e) {
                $erros++;
            }
        }

        $total = count($pks);
        $sucesso = $total - $erros;

        $msg = [];
        if ($sucesso > 0) {
            $msg[] = "$sucesso registro(s) excluído(s) com sucesso.";
        }
        if ($erros > 0) {
            $msg[] = "$erros registro(s) não puderam ser excluídos por estarem relacionados.";
        }

        $mensagemFinal = implode('<br>', $msg);
        $tipo = $erros > 0 ? ($sucesso > 0 ? 'warning' : 'error') : 'success';

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'forceClose' => true,
                'forceReload' => '#crud-datatable-pjax',
                'message' => ['type' => $tipo, 'text' => $mensagemFinal]
            ];
        }

        Yii::$app->session->setFlash($tipo, $mensagemFinal);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Assunto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Assunto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Assunto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
