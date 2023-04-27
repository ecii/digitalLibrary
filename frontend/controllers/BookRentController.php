<?php

namespace frontend\controllers;

use common\models\Book;
use common\models\BookRent;
use common\models\BookRentSearch;
use SebastianBergmann\CodeCoverage\Report\Html\Renderer;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * BookRentController implements the CRUD actions for BookRent model.
 */
class BookRentController extends Controller
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
     * Lists all BookRent models.
     *
     * @return string
     */
    public function actionIndex($rent_record_id) 
    // berikan parameter rent record id untuk mengisi data record pemesanan berdasarkan pilihan dari
    //index by member
    {
        $searchModel = new BookRentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andFilterWhere(['rent_record_id'=>$rent_record_id]);
    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'rent_record_id'=>$rent_record_id,
            // 'array_book'=>$array_book
        ]);
    }

   
    /**
     * Displays a single BookRent model.
     * @param int $id_book_rent Id Book Rent
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_book_rent)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_book_rent),
        ]);
    }

    /**
     * Creates a new BookRent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($rent_record_id)
    {
        $model = new BookRent();
        $model->created_at = date('Y-m-d'); // karena kita hanya mau digunakan pada saat file ini dijalankan saja
        $model->created_by = Yii::$app->user->id; 
        $model->rent_record_id=$rent_record_id; // menampilkan data yang ada di view
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index', 'rent_record_id' => $model->rent_record_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BookRent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_book_rent Id Book Rent
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_book_rent)
    {
        $model = $this->findModel($id_book_rent);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id_book_rent' => $model->id_book_rent]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BookRent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_book_rent Id Book Rent
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_book_rent)
    {
       
        $dataBook=$this->findModel($id_book_rent);//ambil data yaang akan mau dihapus tp disimpan dl di $databook
        $rent_record_id=$dataBook->rent_record_id;//
        $dataBook->delete();


        return $this->redirect(['index','rent_record_id' => $rent_record_id]);
    }

    /**
     * Finds the BookRent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_book_rent Id Book Rent
     * @return BookRent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_book_rent)
    {
        if (($model = BookRent::findOne(['id_book_rent' => $id_book_rent])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionReportRent(){
        $model=new BookRent();
        return $this->render('report-rent',['model'=>$model]);
        //diambil dari view report rent
    }
}
