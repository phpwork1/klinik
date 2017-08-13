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
$brandName = empty($parameter->app_name) ? 'FillBlank' : $parameter->app_name;

$person = \backend\models\Person::findOne(Yii::$app->user->identity->person_id);
$personName = explode(' ', trim($person->name))[0];

//$mail = \backend\models\Mail::findAll(['read' => '1'])
$brandName = common\components\helpers\AppConst::APP_NAME_CLINIC;


?>

<header class="main-header ">

    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <?= Html::a('<span class="logo-lg"><b>' . $brandName . '</b></span>', Yii::$app->getHomeUrl(), ['class' => "navbar-brand"]) ?>
            </div>

            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <!-- Home icon get active only when current page is index-->
                    <li class="<?= (Yii::$app->controller->action->id == "" || Yii::$app->controller->action->id == "index") ? "active" : ""; ?>">
                        <a href="<?= Yii::$app->homeUrl ?>">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>

                    <?php if (Yii::$app->user->identity->role == User::ROLE_ADMINISTRATOR) { ?>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Master <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">

                                <li><?= Html::a('<i class="fa fa-circle-o"></i> ' . "Agama", ['/religion']); ?></li>
                                <li><?= Html::a('<i class="fa fa-circle-o"></i> ' . "Pekerjaan", ['/job']); ?></li>
                                <li class="divider"></li>
                                <li><?= Html::a('<i class="fa fa-circle-o"></i> ' . "Tindakan Praktik", ['/practice-action']); ?></li>
                                <li><?= Html::a('<i class="fa fa-circle-o"></i> ' . "Tindakan Klinik Kecantikan", ['/clinical-action']); ?></li>
                                <li class="divider"></li>
                                <li><?= Html::a('<i class="fa fa-circle-o"></i> ' . "Tabel Diagnosis", ['/diagnosis']); ?></li>
                            </ul>
                        </li>

                    <?php } ?>

                    <li class="dropdown">
                        <?= Html::a("Pasien", ['/patient']); ?>
                    </li>

                    <li class="dropdown">
                        <?= Html::a("Registrasi", ['/common-upload']); ?>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Laporan <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <?= Html::a('<i class="fa fa-circle-o"></i> ' . "Pasien Berobat", ['/common-upload']); ?>
                            </li>
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
