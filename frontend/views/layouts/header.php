<?php

use yii\helpers\Html;
use backend\models\Parameter;
use common\models\User;

/* @var $this \yii\web\View */
/* @var $content string */

## GET PARAMETERS, SAVE TO SESSION
if (empty(Yii::$app->session->get('setting'))) {
    $parameter = Parameter::findOne(1);
    Yii::$app->session->set('setting', $parameter);
}
$parameter = Yii::$app->session->get('setting');
//$brandName = empty($parameter->app_name) ? 'FillBlank' : $parameter->app_name;

$person = \backend\models\Person::findOne(Yii::$app->user->identity->person_id);
$personName = explode(' ', trim($person->name))[0];

//$mail = \backend\models\Mail::findAll(['read' => '1'])
$brandName = common\components\helpers\AppConst::APP_NAME_PHARMACY;
?>

<header class="main-header">

    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <?= Html::a('<span class="logo-lg"><b>' . $brandName . '</b></span>', Yii::$app->getHomeUrl(), ['class' => "navbar-brand"]) ?>
            </div>

            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="<?= (Yii::$app->controller->action->id == "" || Yii::$app->controller->action->id == "index") ? "active" : ""; ?>">
                        <a href="<?= Yii::$app->homeUrl ?>">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>

                    <?php if (Yii::$app->user->identity->role == User::ROLE_ADMINISTRATOR) { ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Master <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><?= Html::a('<i class="fa fa-circle-o"></i> ' . "Kategori Barang", ['/item-category']); ?></li>
                                <li><?= Html::a('<i class="fa fa-circle-o"></i> ' . "Data Barang", ['/item']); ?></li>
                                <li class="divider"></li>
                                <li><?= Html::a('<i class="fa fa-circle-o"></i> ' . "Suplier", ['/supplier']); ?></li>
                                <li><?= Html::a('<i class="fa fa-circle-o"></i> ' . "Pelanggan", ['/customer']); ?></li>
                                <li class="divider"></li>
                                <li><?= Html::a('<i class="fa fa-circle-o"></i> ' . "Admin Profile", ['/person']); ?></li>
                            </ul>
                        </li>
                    <?php } ?>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Transaksi <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><?= Html::a("Form Pembelian Barang", ['/goods-purchase/create']); ?></li>
                            <li><?= Html::a("Informasi Pembelian Barang", ['/goods-purchase']); ?></li>
                            <li class="divider"></li>
                            <li><?= Html::a("Penjualan External", ['/sales', 'type' => '1']); ?></li>
                            <li class="divider"></li>
                            <li><?= Html::a("Penjualan Internal", ['/sales', 'type' => '2']); ?></li>
                            <li class="divider"></li>
                            <li><?= Html::a("Retur Pembelian", ['/goods-purchase-return']); ?></li>
                            <li><?= Html::a("Retur Penjualan", ['/sales-return']); ?></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="?show=laporan-barang"> Daftar Barang</a></li>
                            <li><a href="?show=laporan-suplier"> Daftar Suplier</a></li>
                            <li><a href="?show=laporan-pelanggan"> Daftar Pelanggan</a></li>
                            <li class="divider"></li>
                            <li><a href="?show=laporan-pembelian"> Pembelian Barang</a></li>
                            <li><a href="?show=laporan-penjualan"> Penjualan Barang External</a></li>
                            <li><a href="?show=laporan-penjualan-internal"> Penjualan Barang Internal</a></li>
                            <li class="divider"></li>
                            <li><a href="?show=laporan-retur-pembelian"> Retur Pembelian</a></li>
                            <li><a href="?show=laporan-retur-penjualan"> Retur Penjualan</a></li>
                            <li class="divider"></li>
                            <li><a href="?show=laporan-stock-barang"> Stock Barang</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="navbar-custom-menu">

                <ul class="nav navbar-nav">

                    <!-- Messages: style can be found in dropdown.less-->
                    <!-- Tasks: style can be found in dropdown.less -->
                    <!-- User Account: style can be found in dropdown.less -->

                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?= Yii::getAlias('@web') . '/uploads/people/thumb-' . $person->photo ?>"
                                 class="user-image" alt="User Image"/>
                            <span class="hidden-xs"><?= $personName ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?= Yii::getAlias('@web') . '/uploads/people/thumb-' . $person->photo ?>"
                                     class="img-circle" alt="User Image"/>
                                <p><?php
                                    echo $person->name . ' - ';
                                    echo \common\models\User::$allRoles[Yii::$app->user->identity->role];
                                    Yii::$app->formatter->locale = 'id-ID';
                                    echo "<small>Bergabung dari tanggal " . Yii::$app->formatter->asDate($person->created_at, 'long') . '</small>';
                                    ?></p>
                            </li>
                            <!-- Menu Body -->
                            <?php
                            //                        if (Yii::$app->user->identity->role == \common\models\User::ROLE_CUSTOMER):
                            //                            $customer = \backend\models\Customer::findOne(Yii::$app->user->identity->partner_id);
                            //                            $salesLink = Html::a($customer->sales->name, ['/sales/view', ])
                            //                            echo "<li class='user-body'><div class='col-xs-12 text-center'>Sales Anda: </div></li>";
                            //                        endif;
                            ?>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <?= Html::a(Yii::t('app', 'Profile'), ['/person/view', 'id' => $person->id], ['class' => 'btn btn-default btn-flat']) ?>
                                    <?php if (Yii::$app->user->identity->role == User::ROLE_ADMINISTRATOR) {
                                        echo Html::a(Yii::t('app', 'User Page'), ['/user/index', 'UserSearch[currentRole]' => Yii::$app->user->identity->role], ['class' => 'btn btn-default btn-flat']);
                                    } ?>
                                </div>
                                <div class="pull-right">
                                    <?= Html::a(
                                        'Sign out',
                                        ['/site/logout'],
                                        ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                    ) ?>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
