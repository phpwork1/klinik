<?php

use yii\helpers\Html;
use common\components\helpers\AppConst;
use yii\grid\GridView;

/* @var $this yii\web\View */

$this->title = 'Klinik';
?>
<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pasien / Member</span>
                    <span class="info-box-number">
                  	<small>
                    	<?php echo \backend\models\Patient::find()->count(); ?> orang
                    </small>
                  </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Registrasi</span>
                    <span class="info-box-number">
					<?php
                    $tglskrg = date("Y-m-d");
                    ?>
                        <small>Praktik : <?php echo \backend\models\Registration::find()->where(['r_position' => 0, 'r_date' => Yii::$app->formatter->asDate(time(), AppConst::FORMAT_DB_DATE_PHP)])->count(); ?>
                            orang</small>
                  </span>
                    <span class="info-box-number">
                   	<small>Klinik : <?php echo \backend\models\Registration::find()->where(['r_position' => 1, 'r_date' => Yii::$app->formatter->asDate(time(), AppConst::FORMAT_DB_DATE_PHP)])->count(); ?>
                        orang</small>
                  </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pasien / Member <br> Ultah</span>
                    <span class="info-box-number">
                  	<small>
                    	<?php echo \backend\models\Patient::find()->where(['p_dob' => Yii::$app->formatter->asDate(time(), AppConst::FORMAT_DB_DATE_PHP)])->count(); ?>
                        orang
                    </small>
                  </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pasien / Member <br>Baru</span>
                    <span class="info-box-number">
					<?php echo \backend\models\Patient::find()->where(['p_registration_date' => Yii::$app->formatter->asDate(time(), AppConst::FORMAT_DB_DATE_PHP)])->count(); ?>
                        orang
                  </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <div class="col-md-8">
            <!-- TABLE: LATEST ORDERS -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Registrasi Pasien</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php
                    $searchModel = new \backend\models\RegistrationSearch();
                    $searchModel->r_date = Yii::$app->formatter->asDate(time(), AppConst::FORMAT_DB_DATE_PHP);
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->pagination->pageSize = 8;
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'r_number',
                            [
                                'attribute' => 'patient_id',
                                'value' => 'patient.p_name',
                                'label' => 'Nama Pasien',
                            ],
                            [
                                'attribute' => 'r_position',
                                'value' => 'r_position_desc',
                            ],
                            'r_complaint',
                        ],
                    ]);
                    ?>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?= Html::a("Lihat Pendaftaran", ['/registration'], ['class' => 'btn btn-sm btn-info btn-flat pull-left']); ?>
                    <?= Html::a("Pasien Baru", ['/patient'], ['class' => 'btn btn-sm btn-default btn-flat pull-right']); ?>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div><!-- /.col -->

        <div class="col-md-4">
            <!-- REGISTRASI PASIEN / MEMBER -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Pasien / Member Baru</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        <?php $patients = \backend\models\Patient::find()->orderBy(['p_registration_date' => SORT_DESC])->limit(5)->all(); ?>
                        <?php foreach($patients as $key => $patient) : ?>
                        <li class="item">
                            <div class="product-img">
                                <img src="<?= Yii::getAlias('@web') . '/uploads/etc/no-image.jpg' ?>" alt="Product Image">
                            </div>
                            <div class="product-info">
                                <a class="product-title"><?= $patient->p_name ?><span class="label label-primary pull-right"><?= $patient->p_medical_number ?></span></a>
                                <span class="product-description"><?= sprintf("%s HP: %s", $patient->p_address, $patient->p_contact_number); ?></span>
                            </div>
                        </li><!-- /.item -->
                        <?php endforeach; ?>
                    </ul>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                    <?= Html::a("Pasien Lainnya", ['/patient'], ['class' => 'uppercase']); ?>
                </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->

