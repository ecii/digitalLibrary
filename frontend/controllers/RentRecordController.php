<?php

namespace frontend\controllers;

use common\models\BookRent;
use common\models\Profile;
use common\models\ProfileSearch;
use common\models\RentRecord;
use common\models\RentRecordSearch;
use common\models\BookRentSearch;
use common\models\Penalty;
use DateTime;
use PhpParser\Node\Expr\New_;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
/**
 * RentRecordController implements the CRUD actions for RentRecord model.
 */
class RentRecordController extends Controller
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
     * Lists all RentRecord models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RentRecordSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReturn($id_rent_record){
        $model=new RentRecord();
        $model->updateAll(['rent_status'=>'RETURN','return_at'=>date('Y-m-d')],['id_rent_record'=>$id_rent_record]);
        return $this->redirect(['index']);
        
    }

    public function actionPayment(){
        //$id_rent_record=$_GET['rent_record_id'];

        // $searchModel = new RentRecordSearch();
        // $dataProvider = $searchModel->search($this->request->queryParams);
        // $dataProvider->query->andFilterWhere(['rent_record_id'=>$id_rent_record]);
        // $data = BookRent::findAll($id_rent_record);
        // foreach($data as $array){
        //     echo"
        //     <table>
        //     <tr>
        //         <td>id rent book :".$array->id_book_rent."</td>
        //     </tr>
        //     </table>
            
        //     ";
        // }

        // $model = new BookRentSearch();
        // $model->findModel($id_rent_record);
        // echo $model->id_book_rent;
        
        $model = new BookRent();
        return $this->render('../penalty/index-payment',['model'=>$model]);

        // $id_rent_record=$_GET['rent_record_id'];
        // $model=New BookRent();
        // $data = $model->find()->where($id_rent_record)->all();
        // foreach($data as $array){

        //     echo $array->id_book_rent;
        //     //$tglKembali=new DateTime($array['return_at']);

        //     // $selisih=$tglKembali->diff($tglPinjam);

        //     // $hari=$selisih->d;
        //     // $lamaHari=$hari-7;
        //     // $denda=$lamaHari*2000;

        //     //return $denda;
        // }

    }
    public function actionDataRent($id_profile)
    {
        $searchModel = new RentRecordSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        // $dataProvider->query->andFilterWhere(['profile_id'=>$id_profile,'rent_status'=>'*']);
        $dataProvider->query->andFilterWhere(['profile_id'=>$id_profile]);
        //select * from tabel rent record where profile id=$idprofile;

        $dataProfile = Profile::findOne($id_profile);//select * from tabel profile whre id_profile=$id_profile

        return $this->render('index-by-member', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProfile' => $dataProfile
        ]);
    }
    public function actionListProfile(){
        $searchModel = new ProfileSearch();//inisiasi model yang akan digunakan
        $dataProvider = $searchModel->search($this->request->queryParams);//cari data sesuai dengan parameter

        return $this->render('index-profile', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);//lemparan seluruh data  yang ada di profile ke view yang ada di index-profile.php
    }
    /**
     * Displays a single RentRecord model.
     * @param int $id_rent_record Id Rent Record
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_rent_record)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_rent_record),
        ]);
    }

    /**
     * Creates a new RentRecord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id_profile)
    {
        $model = new RentRecord();
        //$model->created_at = date('Y-m-d'); 
        $model->created_by = Yii::$app->user->id;
        $model->profile_id = $id_profile;// karena pilihan maka dibuat parameter
        $model->rent_status= 'RENT';
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
     * Updates an existing RentRecord model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_rent_record Id Rent Record
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdate($id_rent_record,$created_at)
    {
        $model=new RentRecord();
                
        if ($model->save()) {
            
            return $this->redirect(['index']);
        }

        return $this->render('_formUpdate', [
            'model' =>$model,
        ]);
    }

    /**
     * Deletes an existing RentRecord model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_rent_record Id Rent Record
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_rent_record)
    {
        $this->findModel($id_rent_record)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RentRecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_rent_record Id Rent Record
     * @return RentRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_rent_record)
    {
        if (($model = RentRecord::findOne(['id_rent_record' => $id_rent_record])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    
}
