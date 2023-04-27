<?php

namespace frontend\controllers;

use common\models\PenaltyPrice;
use common\models\PenaltyPriceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PenaltyPriceController implements the CRUD actions for PenaltyPrice model.
 */
class PenaltyPriceController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all PenaltyPrice models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PenaltyPriceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PenaltyPrice model.
     * @param int $id_price Id Price
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_price)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_price),
        ]);
    }

    /**
     * Creates a new PenaltyPrice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new PenaltyPrice();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_price' => $model->id_price]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PenaltyPrice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_price Id Price
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_price)
    {
        $model = $this->findModel($id_price);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_price' => $model->id_price]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PenaltyPrice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_price Id Price
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_price)
    {
        $this->findModel($id_price)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PenaltyPrice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_price Id Price
     * @return PenaltyPrice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_price)
    {
        if (($model = PenaltyPrice::findOne(['id_price' => $id_price])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
