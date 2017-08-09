<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use common\models\User;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'ruleConfig' => ['class' => '\common\components\AccessRule'],
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'captcha', 'logout'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'pdf'],
                        'allow' => true,
                        'roles' => [User::ROLE_ADMINISTRATOR, User::ROLE_CHAIRMAN, User::ROLE_DEPUTY_CHAIRMAN, User::ROLE_SECRETARY, User::ROLE_TRANSPORTATION],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_ADMINISTRATOR,
                            User::ROLE_CHAIRMAN,
                            User::ROLE_DEPUTY_CHAIRMAN,
                            User::ROLE_SECRETARY,
                            User::ROLE_TREASURER,
                            User::ROLE_TRANSPORTATION,
                            User::ROLE_ACCOMMODATION,
                            User::ROLE_IT,
                            User::ROLE_CONTACT_PERSON,
                            User::ROLE_PARTICIPANT],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_ADMINISTRATOR,
                            User::ROLE_CHAIRMAN,
                            User::ROLE_DEPUTY_CHAIRMAN,
                            User::ROLE_SECRETARY,
                            User::ROLE_TREASURER,
                            User::ROLE_TRANSPORTATION,
                            User::ROLE_ACCOMMODATION,
                            User::ROLE_IT,
                            User::ROLE_CONTACT_PERSON],
                    ],
                    [
                        'actions' => ['index', 'report', 'backup-db'],
                        'allow' => true,
                        'roles' => [User::ROLE_ADMINISTRATOR, User::ROLE_CHAIRMAN, User::ROLE_DEPUTY_CHAIRMAN],
                    ],
                    [
                        'actions' => ['import-db', 'clear-transaction-data'],
                        'allow' => true,
                        'roles' => [User::ROLE_ADMINISTRATOR, User::ROLE_CHAIRMAN],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    private function getDsnAttribute($name, $dsn) {
        if (preg_match('/' . $name . '=([^;]*)/', $dsn, $match)) {
            return $match[1];
        } else {
            return null;
        }
    }

    public function actionPdf() {
//        $pdf = new \FPDF();
//        $pdf->AddPage();
//        $pdf->SetFont('Arial', 'B', 16);
//        $pdf->Cell(40, 10, 'Hello World');
//        $pdf->Output();
//        exit;
        $this->renderAjax('pdf');
    }

    public function actionIndex() {
        $data = [];

        return $this->render('index', ['data' => $data]);
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->login()) {
                if (Yii::$app->user->identity->role == User::ROLE_PARTICIPANT) {
                    Yii::$app->user->logout();
                    Yii::$app->session->setFlash('danger', 'This is admin section. Participant cannot login');
                    $this->redirect(['login']);
                } else {
                    Yii::$app->session->setFlash('success', sprintf("%s %s",'Welcome back. ', Yii::$app->user->identity->getRoleName()));
                    return $this->goBack();
                }
            } else {
                Yii::$app->session->setFlash('danger', 'Username / password salah.');
                return $this->render('login', ['model' => $model]);
            }
        } else {
            return $this->render('login', ['model' => $model]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionReport() {
        return $this->render('report');
    }

    /**
     * Backup database to D:/backup_db
     * @return flashMessage
     */
    public function actionBackupDb() {
        echo 'Memulai backup database';

        ## GET DATABASE NAME
        $db = Yii::$app->getDb();
        $dbName = $this->getDsnAttribute('dbname', $db->dsn);

        $setting = Yii::$app->session->get('setting');
        $appName = strtolower(str_replace(' ', '', $setting->app_name));

        ## create directory for storing the file
        $backup_dir = "C:/backup_db/" . $appName;
        if (!is_dir($backup_dir)) {
            mkdir($backup_dir, true);
        }

        # create files levels by year, month, date.
        $year = date('Y');
        if (!is_dir("$backup_dir/$year")) {
            mkdir("$backup_dir/$year");
        }
        $month = date('m');
        if (!is_dir("$backup_dir/$year/$month")) {
            mkdir("$backup_dir/$year/$month");
        }

        $dir = "$backup_dir/$year/$month";
        # run mysqldump
        //$today = date('H-i');
        $today = date('Y-m-d');
        exec("mysqldump -u root $dbName > $dir/{$appName}_$today.txt");

        Yii::$app->session->setFlash('success', 'Data berhasil di-backup.');
        return $this->goHome();
    }

    /**
     * Clear all transaction history
     * @return flashMessage
     */
    public function actionClearTransactionData() {
        if (Yii::$app->request->isPost) {
            echo 'Data yang dibersihkan oleh modul ini: Mutasi Produk, seluruh data Pembelian dan Penjualan.';
            echo 'Memulai proses membersihkan data transaksi..<br />';
            set_time_limit(0);
            //TRUNCATE product;
            //TRUNCATE product_brand;
            //TRUNCATE product_category;
            //TRUNCATE product_unit;
            //TRUNCATE customer;
            //TRUNCATE supplier;
            //TRUNCATE price_list;
            //TRUNCATE price_category;
            $connection = Yii::$app->getDb();
            $command = $connection->createCommand('
            SET FOREIGN_KEY_CHECKS = 0;
            TRUNCATE cash_sale;
            TRUNCATE expense;
            TRUNCATE income;
            TRUNCATE product_history;
            TRUNCATE purchase_order;
            TRUNCATE purchase_order_detail;
            TRUNCATE purchase_payment;
            TRUNCATE purchase_receipt;
            TRUNCATE purchase_return;
            TRUNCATE purchase_return_detail;
            TRUNCATE sale_order;
            TRUNCATE sale_order_detail;
            TRUNCATE sale_payment;
            TRUNCATE sale_receipt;
            TRUNCATE sale_return;
            TRUNCATE sale_return_detail;
            SET FOREIGN_KEY_CHECKS = 1;
        ');
            if ($command->query() !== FALSE) {
                Yii::$app->session->setFlash('success', 'Data transaksi berhasil dibersihkan.');
            } else {
                Yii::$app->session->setFlash('danger', 'Data transaksi gagal dibersihkan.');
            }
            return $this->goHome();
        } else {
            return $this->render('clear-transaction-data');
        }
    }

    /**
     * Import database from file
     * @return flashMessage
     */
    public function actionImportDb() {
        ## GET DATABASE NAME
        $db = Yii::$app->getDb();
        $dbName = $this->getDsnAttribute('dbname', $db->dsn);

        ## LOAD UPLOAD FORM MODEL
        $model = new \backend\models\UploadForm();

        if (Yii::$app->request->isPost) {
            $model->sqldump = \yii\web\UploadedFile::getInstance($model, 'sqldump');
            if ($model->upload()) {
                echo 'Memulai import database. Dapat memakan waktu sangat lama..';
                set_time_limit(0);
                $basePath = Yii::$app->basePath . '/web/';
                $filename = 'uploads/sqldump.sql';

                ## WINDOWS, DROP, CREATE AND POPULATE DATABASE
                system('mysqladmin -f -u root drop ' . $dbName);
                system('mysqladmin -u root create ' . $dbName);
                system('mysql -u root --database ' . $dbName . '< ' . $basePath . $filename);

                Yii::$app->session->setFlash('success', 'Data berhasil dimuat ulang.');
                return $this->goHome();
            }
        }

        return $this->render('import-db', ['model' => $model]);
    }

    public function actionOptimizeDb() {
        echo 'Memulai optimasi database. Dapat memakan waktu sangat lama..';
        set_time_limit(0);
        system('mysqlcheck -o shopee -u root');
        Yii::$app->session->setFlash('success', 'Data berhasil optimasi.');
    }

    public function actionRepairDb() {
        echo 'Memulai reparasi database. Dapat memakan waktu sangat lama..';
        set_time_limit(0);
        system('mysqlcheck -r shopee -u root');
        Yii::$app->session->setFlash('success', 'Data berhasil perbaiki.');
    }

}
