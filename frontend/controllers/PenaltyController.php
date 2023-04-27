<?php

namespace frontend\controllers;
use kartik\mpdf\Pdf;
use common\models\BookRent;
use common\models\Penalty;
use common\models\PenaltySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PenaltyController implements the CRUD actions for Penalty model.
 */
class PenaltyController extends Controller
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
     * Lists all Penalty models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PenaltySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    // public function actionPayment($rent_record_id){
    //     $model = new Penalty();
    //     $searchModel = new PenaltySearch();
    //     $dataProvider = $searchModel->search($this->request->queryParams);
    //     $dataProvider->query->andFilterWhere(['rent_record_id'=>$rent_record_id]);

    //     $model->hitungDenda();
    //     return $this->render('index_payment', [
    //         'Model' => $model
    //     ]);
    // }

    public function actionPrint(){
        $model=new BookRent();
        $content=$this->renderPartial('print-payment',
            ['model'=>$model]
        );
       $pdf = new Pdf([
           // set to use core fonts only
           'mode' => Pdf::MODE_CORE, 
           // A4 paper format
           'format' => Pdf::FORMAT_A4, 
           // portrait orientation
           'orientation' => Pdf::ORIENT_LANDSCAPE, 
           // stream to browser inline
           'destination' => Pdf::DEST_BROWSER, 
           // your html content input
           'content' => $content,  
           // format content from your own css file if needed or use the
           // enhanced bootstrap css built by Krajee for mPDF formatting 
           'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
           // any css to be embedded if required
           'cssInline' => '.kv-heading-1{font-size:18px}', 
            // set mPDF properties on the fly
           'options' => ['title' => 'Pasaribu\'s DigLib'],
            // call mPDF methods on the fly
           'methods' => [ 
            //    'SetHeader'=>['Resi Pembayaran'], 
            //    'SetFooter'=>['{PAGENO}'],
           ]
       ]);
       
       // return the pdf output as per the destination setting
       return $pdf->render(); 
          
    }

    /**
     * Displays a single Penalty model.
     * @param int $id_penalty Id Penalty
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_penalty)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_penalty),
        ]);
    }

    /**
     * Creates a new Penalty model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Penalty();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_penalty' => $model->id_penalty]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Penalty model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_penalty Id Penalty
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_penalty)
    {
        $model = $this->findModel($id_penalty);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_penalty' => $model->id_penalty]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Penalty model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_penalty Id Penalty
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_penalty)
    {
        $this->findModel($id_penalty)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Penalty model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_penalty Id Penalty
     * @return Penalty the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_penalty)
    {
        if (($model = Penalty::findOne(['id_penalty' => $id_penalty])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
