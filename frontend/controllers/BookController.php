<?php

namespace frontend\controllers;

use common\models\Book;
use common\models\BookSearch;
use common\models\UploadCover;
use kartik\mpdf\Pdf;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii ;
use yii\web\UploadedFile;

/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller
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
     * Lists all Book models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCover($id_book){
        $model=new Book();
        $mUpload=new UploadCover();

        if($this->request->isPost){
            if($mUpload->load($this->request->post())){
                $mUpload->cover = UploadedFile::getInstance($mUpload,'cover');
                $mUpload->upload($id_book);//buat function untuk upload
                Yii::$app->session->setFlash('warning','File Cover Berhasil Diupload');
                return $this->redirect(['index']);
            }
        }
        return $this->renderAjax('_form-cover',[
            'model' => $model,
            'mUpload' => $mUpload
        ]);


    }
    public function actionPrint($id_book)
    {
     $content=$this->renderPartial('print', [
         'model' => $this->findModel($id_book),
        ]);
    $pdf = new Pdf([
        // set to use core fonts only
        'mode' => Pdf::MODE_CORE, 
        // A4 paper format
        'format' => Pdf::FORMAT_A4, 
        // portrait orientation
        'orientation' => Pdf::ORIENT_PORTRAIT, 
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
            'SetHeader'=>['Detail Book'], 
            'SetFooter'=>['{PAGENO}'],
        ]
    ]);
    
    // return the pdf output as per the destination setting
    return $pdf->render(); 
       
    }

    /**
     * Displays a single Book model.
     * @param int $id_book Id Book
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_book)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_book),
        ]);
    }

    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Book();
        $model->created_at = date('Y-m-d'); // karena kita hanya mau digunakan pada saat file ini dijalankan saja
        $model->created_by = Yii::$app->user->id;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_book Id Book
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_book)
    {
        $model = $this->findModel($id_book);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Book model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_book Id Book
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_book)
    {
        $this->findModel($id_book)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_book Id Book
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_book)
    {
        if (($model = Book::findOne(['id_book' => $id_book])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionEciiPinter($num1=0,$num2=0,$num3=0)//kalau tidak diisi nilainya nol
    {
        $mBook=new Book(); //meload fungsi fungsi yang ada dalam model book.php

        $nama="ecii";
        $boru="Pasaribu";

        $hitunganEcii=$mBook->hitungKali($num1,$num2,$num3);
        //masukkan ke variabel hitung ecii fungsi hitung kali yang ada di model book.php

        return $this->render('eci-memang-pinter',[
            'nama_aku'=>$nama,
            // masukkan ke variabel baru yang akan dilempar dengan nama $nama_aku value yang ada di $nama
            // ke halaman view eci-memang-pinter 
            'boru_aku'=>$boru,
            'hasil'=>$hitunganEcii,
        ]);
    }
}
