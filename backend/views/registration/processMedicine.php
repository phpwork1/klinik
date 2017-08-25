<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 18/8/2017
 * Time: 2:55 PM
 */
/* @var $medicine backend\models\RMedicine */
/* @var $doctorAction backend\models\RDoctorAction */
/* @var $registration_id int */
/* @var $position int */
/* @var $searchModelRMedicine backend\models\RMedicineSearch */
/* @var $searchModelRmDetail backend\models\RmDetail */
/* @var $searchModelRDoctorAction backend\models\RDoctorActionSearch */

/* @var $rmDetail backend\models\RmDetail */

use backend\assets\ProcessMedicineAsset;
use yii\jui\Tabs;

ProcessMedicineAsset::register($this);
?>

<?= Tabs::widget([
    'items' => [
        [
            'label' => 'Therapi Obat',
            'content' => $this->render('medicineTherapy', ['searchModelRMedicine' => $searchModelRMedicine, 'model' => $medicine, 'registration_id' => $registration_id]),
            'active' => true,
        ],
        [
            'label' => 'Therapi Obat Racikan',
            'content' => $this->render('medicineBlendedTherapy', ['rmDetail' => $rmDetail, 'searchModelRMedicine' => $searchModelRMedicine, 'searchModelRmDetail' => $searchModelRmDetail, 'model' => $medicine, 'registration_id' => $registration_id]),
        ],
        [
            'label' => 'Tindakan Dokter',
            'content' => $this->render('medicineDoctorAction', ['searchModelRmDetail' => $searchModelRmDetail, 'searchModelRDoctorAction' => $searchModelRDoctorAction, 'position' => $position, 'model' => $doctorAction, 'registration_id' => $registration_id]),
        ],
    ],
    'options' => ['tag' => 'div', 'id' => 'tabs-medicine'],
    'itemOptions' => ['tag' => 'div'],
    'clientOptions' => ['collapsible' => false],
]) ?>
