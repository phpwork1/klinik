<?php

namespace backend\controllers;

use backend\models\ClinicalAction;
use backend\models\DrugAllergies;
use backend\models\PracticeAction;
use backend\models\RConsultation;
use backend\models\RDiagnosis;
use backend\models\RDiagnosisSearch;
use backend\models\RDoctorAction;
use backend\models\RDoctorActionSearch;
use backend\models\RmDetail;
use backend\models\RmDetailSearch;
use backend\models\RMedicine;
use backend\models\RMedicineSearch;
use common\components\helpers\AppConst;
use Yii;
use backend\models\Registration;
use backend\models\RegistrationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use frontend\models\Item;

/**
 * RegistrationController implements the CRUD actions for Registration model.
 */
class RegistrationController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Registration models.
     * @return mixed
     */
    public function actionReport()
    {
        $searchModel = new RegistrationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$total = $searchModel->total(Yii::$app->request->queryParams, ['field' => 'total']);

        return $this->render('report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //'total' => $total,
        ]);
    }


    /**
     * Lists all Registration models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RegistrationSearch(['formNameParam' => 'beforeCheck']);
        //bisa di taruh di search
        $searchModel->r_date = Yii::$app->formatter->asDate(time(), AppConst::FORMAT_DB_DATE_PHP);
        $searchModel->r_checked = 0;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchModelAfterCheck = new RegistrationSearch(['formNameParam' => 'afterCheck']);
        $searchModelAfterCheck->r_date = Yii::$app->formatter->asDate(time(), AppConst::FORMAT_DB_DATE_PHP);
        $searchModelAfterCheck->r_checked = 1;
        $dataProviderAfterCheck = $searchModelAfterCheck->searchAfterCheck(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelAfterCheck' => $searchModelAfterCheck,
            'dataProviderAfterCheck' => $dataProviderAfterCheck,
        ]);
    }

    /**
     * Displays a single Registration model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * Creates a new Registration model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Registration();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Registrasi Berhasil Disimpan.'));
            return $this->redirect(['index']);
        } else {
            $model->r_date = time();
            return $this->render('create', ['model' => $model]);
        }
    }

    /**
     * Updates an existing Registration model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Registrasi Berhasil Diproses.'));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', ['model' => $model]);
        }
    }

    /**
     * Deletes an existing Registration model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', Yii::t('app', 'Registrasi Berhasil Dihapus.'));
        return $this->redirect(['index']);
    }

    public function actionProcess($id)
    {
        $model = $this->findModel($id);

        //gridview search model
        $searchModelRMedicine = new RMedicineSearch();
        $searchModelRmDetail = new RmDetailSearch();
        $searchModelRDoctorAction = new RDoctorActionSearch();
        $searchModelRDiagnosis = new RDiagnosisSearch();
        $searchModelRegistrationSearch = new RegistrationSearch();

        //Consultation
        $consultation = empty($model->rConsultations) ? new RConsultation() : $model->rConsultations[0];
        //Drug Allergies
        $drugAllergiesModel = new DrugAllergies();
        $model->getDrugAllergiesData();
        //medicine
        $medicine = new RMedicine();
        //Doctor Action
        $doctorAction = new RDoctorAction();
        //position
        $position = $model->r_position;
        //RmDetail
        $rmDetail = new RmDetail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Registration Berhasil Diproses.'));
            return $this->redirect(['index']);
        } else {
            return $this->render('process', [
                'model' => $model,
                'consultation' => $consultation,
                'medicine' => $medicine,
                'doctorAction' => $doctorAction,
                'position' => $position,
                'rmDetail' => $rmDetail,
                'drugAllergiesModel' => $drugAllergiesModel,
                'searchModelRMedicine' => $searchModelRMedicine,
                'searchModelRmDetail' => $searchModelRmDetail,
                'searchModelRDoctorAction' => $searchModelRDoctorAction,
                'searchModelRDiagnosis' => $searchModelRDiagnosis,
                'searchModelRegistrationSearch' => $searchModelRegistrationSearch,
            ]);
        }
    }

    public function actionPatientReport()
    {
        $searchModel = new RegistrationSearch();

        if (Yii::$app->request->isPost) {
            $requestData = Yii::$app->request->post();
            $searchModel->dateFrom = $requestData['RegistrationSearch']['dateFrom'];
            $searchModel->dateTo = $requestData['RegistrationSearch']['dateTo'];
            $dataProvider = $searchModel->searchPatientReport(Yii::$app->request->queryParams);
            return $this->render('patientReport', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            $searchModel->dateFrom = time();
            $searchModel->dateTo = time();
            $dataProvider = $searchModel->searchPatientReport(Yii::$app->request->queryParams);
            return $this->render('patientReport', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionAjaxItemStock()
    {
        $requestData = Yii::$app->request->post();
        $item = Item::find()->select(['i_blend_price', 'i_stock_amount'])->where(['id' => $requestData['item_id']])->one();
        if (!empty($item)) {
            return Json::encode(['item' => $item]);
        }
        return Json::encode(false);
    }

    public function actionAjaxPracticeActionPrice()
    {
        $requestData = Yii::$app->request->post();
        $doctorAction = PracticeAction::find()->select(['pa_cost'])->where(['id' => $requestData['doctor_action_id']])->one();
        if (!empty($doctorAction)) {
            return Json::encode(['doctor_action' => $doctorAction]);
        }
        return Json::encode(false);
    }

    public function actionAjaxClinicalActionPrice()
    {
        $requestData = Yii::$app->request->post();
        $doctorAction = ClinicalAction::find()->select(['ca_cost'])->where(['id' => $requestData['doctor_action_id']])->one();
        if (!empty($doctorAction)) {
            return Json::encode(['doctor_action' => $doctorAction]);
        }
        return Json::encode(false);
    }

    public function actionAjaxDeleteDrugAllergies()
    {
        $requestData = Yii::$app->request->post();
        $drugAllergy = DrugAllergies::find()->where(['id' => $requestData['dataId']])->one();
        $drugAllergy->delete();
    }

    public function actionAjaxMedicineSave(){
        $medicine = new RMedicine();
        if(!$medicine->load(Yii::$app->request->post()) || !$medicine->save()){
            throw new \yii\web\NotFoundHttpException();
        }
    }

    public function actionAjaxMedicineDetailSave(){
        $rmDetail = new RmDetail();
        if(!$rmDetail->load(Yii::$app->request->post()) || !$rmDetail->save()){
            throw new \yii\web\NotFoundHttpException();
        }
    }

    public function actionAjaxMedicineBlendedSave(){
        $medicine = new RMedicine();
        if(!$medicine->load(Yii::$app->request->post()) || !$medicine->save()){
            throw new \yii\web\NotFoundHttpException();
        }
    }

    public function actionAjaxMedicineDoctorActionSave(){
        $doctorAction = new RDoctorAction();
        if(!$doctorAction->load(Yii::$app->request->post()) || !$doctorAction->save()){
            throw new \yii\web\NotFoundHttpException();
        }
    }

    public function actionAjaxProcessCheckingSave(){
        $consultation = new RConsultation();
        if(!$consultation->load(Yii::$app->request->post()) || !$consultation->save()){
            throw new \yii\web\NotFoundHttpException();
        }
    }

    public function actionAjaxProcessCheckingDiagnosisSave(){
        $diagnosis = new RDiagnosis();
        if(!$diagnosis->load(Yii::$app->request->post()) || !$diagnosis->save()){
            throw new \yii\web\NotFoundHttpException();
        }
    }

    public function actionAjaxProcessDrugAllergiesSave(){
        $drugAllergies = new DrugAllergies();
        if(!$drugAllergies->load(Yii::$app->request->post()) || !$drugAllergies->save()){
            throw new \yii\web\NotFoundHttpException();
        }
    }

    public function actionMedicineDelete($id)
    {
        $medicine = RMedicine::find()->where(['id' => $id])->one();
        $medicine->delete();

        //return $this->redirect(['process', 'id' => $registration_id]);
    }

    public function actionMedicineDetailDelete($id)
    {
        $rmDetail = RmDetail::find()->where(['id' => $id])->one();
        $rmDetail->delete();

        //return $this->redirect(['process', 'id' => $registration_id]);
    }

    public function actionDoctorActionDelete($id)
    {
        $doctorAction = RDoctorAction::find()->where(['id' => $id])->one();
        $doctorAction->delete();

        //return $this->redirect(['process', 'id' => $registration_id]);
    }

    public function actionDiagnosisDelete($id)
    {
        $diagnosis = RDiagnosis::find()->where(['id' => $id])->one();
        $diagnosis->delete();

        //return $this->redirect(['process', 'id' => $registration_id]);
    }


    /**
     * Finds the Registration model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Registration the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Registration::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
