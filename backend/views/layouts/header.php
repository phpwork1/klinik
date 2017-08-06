<?php
use yii\helpers\Html;
use backend\models\Parameter;

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
//$brandName = common\components\helpers\AppConst::APP_NAME;


?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . $brandName . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->
                <!-- Tasks: style can be found in dropdown.less -->
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= Yii::getAlias('@web') . '/uploads/people/thumb-' . $person->photo ?>" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?= $personName ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= Yii::getAlias('@web') . '/uploads/people/thumb-' . $person->photo ?>" class="img-circle" alt="User Image"/>
                            <p><?php
                                echo $person->name . ' - ';
                                echo \common\models\User::$allRoles[Yii::$app->user->identity->role];
                                echo "<small>Bergabung dari tanggal " . Yii::$app->formatter->asDate($person->created_at, 'yyyy-MM-dd') . '</small>';
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

                        <!-- Menu Body -->
<!--                        <li class="user-body">-->
<!--                            <div class="col-xs-4 text-center">-->
<!--                                <a href="#">Followers</a>-->
<!--                            </div>-->
<!--                            <div class="col-xs-4 text-center">-->
<!--                                <a href="#">Sales</a>-->
<!--                            </div>-->
<!--                            <div class="col-xs-4 text-center">-->
<!--                                <a href="#">Friends</a>-->
<!--                            </div>-->
<!--                        </li>-->

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= Html::a(Yii::t('app', 'Profile'), ['/person/view', 'id' => $person->id], ['class' => 'btn btn-default btn-flat']) ?>
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
    </nav>
</header>
