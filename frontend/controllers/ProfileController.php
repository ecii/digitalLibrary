<?php

namespace frontend\controllers;

use common\models\Profile;
use common\models\ProfileSearch;
use common\models\Uploadprofile;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends Controller
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
     * Lists all Profile models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProfileSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionProfile($id_profile){
        $model=new Profile();
        $mUpload=new UploadProfile();

        if($this->request->isPost){
            if($mUpload->load($this->request->post())){
                $mUpload->cover = UploadedFile::getInstance($mUpload,'cover');
                $mUpload->upload($id_profile);//buat function untuk upload
                Yii::$app->session->setFlash('warning','File Foto Berhasil Diupload');
                return $this->redirect(['index']);
            }
        }
        return $this->renderAjax('_form-foto',[
            'model' => $model,
            'mUpload' => $mUpload
        ]);


    }

    /**
     * Displays a single Profile model.
     * @param int $id_profile Id Profile
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_profile)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_profile),
        ]);
    }

    /**
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate() // 
    {
        $model = new Profile(); // variabel model menyimpan seluruh yang ada di profile.php

        $model->created_at = date('Y-m-d H:i:s'); // karena kita hanya mau digunakan pada saat file ini dijalankan saja
        $model->created_by = Yii::$app->user->id; 
        if ($this->request->isPost) { // kalau ada data yang dikirim atau disave maka lakukan ini
            if ($model->load($this->request->post()) && $model->save()) { // kalau post dan savenya berhasil maka lakukan
                return $this->redirect(['index', 'id_profile' => $model->id_profile]);

            }
        } else {
            $model->loadDefaultValues(); // kalau tidak ada maka yg diketik akan terhapus semua
        }

        return $this->render('create', [
            'model' => $model,
        ]); // buat file create
    }

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_profile Id Profile
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_profile)
    {
        $model = $this->findModel($id_profile);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_profile' => $model->id_profile]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Profile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_profile Id Profile
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_profile)
    {
        $this->findModel($id_profile)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_profile Id Profile
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_profile)
    {
        if (($model = Profile::findOne(['id_profile' => $id_profile])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

   
}
