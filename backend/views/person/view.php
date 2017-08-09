<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Person */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'People'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'][] = Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-warning', 'title' => Yii::t('app', 'Update')]);
$this->params['buttons'][] = Html::a('<i class="glyphicon glyphicon-remove"></i> ', ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'title' => Yii::t('app', 'Delete'),
    'data' => [
        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
        'method' => 'post',
    ],
]);
?>
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">#<?= $model->id ?> <?= Html::encode($this->title) ?></h3>
    </div>

    <div class="box-body event-type-form table-responsive">
        <table class="table table-hover table-striped detail-view">
            <tr>
                <th><?= $model->getAttributeLabel('name') ?></th>
                <td><?= $model->name ?> <?= $model->getPicture() ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('address') ?></th>
                <td><?= $model->address ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('regency') ?></th>
                <td><?= $model->regency ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('province') ?></th>
                <td><?= $model->province ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('country') ?></th>
                <td><?= $model->country ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('birth_date') ?></th>
                <td><?= $model->birth_date ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('gender') ?></th>
                <td><?= \common\components\helpers\AppConst::$GENDER[$model->gender] ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('religion') ?></th>
                <td><?= $model->religion ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('marriage_status') ?></th>
                <td><?= \common\components\helpers\AppConst::$MARRIAGE_STATUS[$model->marriage_status] ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('nationality') ?></th>
                <td><?= $model->nationality ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('educational_level') ?></th>
                <td><?= $model->educational_level ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('dicipline') ?></th>
                <td><?= $model->dicipline ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('profession') ?></th>
                <td><?= $model->profession ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('majoring') ?></th>
                <td><?= $model->majoring ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('email') ?></th>
                <td><?= $model->email ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('mobile') ?></th>
                <td><?= $model->mobile ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('phone') ?></th>
                <td><?= $model->phone ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('whatsapp') ?></th>
                <td><?= $model->whatsapp ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('fb') ?></th>
                <td><?= $model->fb ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('bbm') ?></th>
                <td><?= $model->bbm ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('line') ?></th>
                <td><?= $model->line ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('skype') ?></th>
                <td><?= $model->skype ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('emergency_contact_name') ?></th>
                <td><?= $model->emergency_contact_name ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('emergency_contact_number') ?></th>
                <td><?= $model->emergency_contact_number ?></td>
            </tr>
            <tr>
                <th><?= $model->getAttributeLabel('created_at') ?></th>
                <td><?= $model->created_at ?>
                    by <?= empty($model->created_by) ? '-' : $model->createdBy->username ?></td>
            </tr>
            <?php if (!empty($model->updated_by)): ?>
                <tr>
                    <th><?= $model->getAttributeLabel('updated_at') ?></th>
                    <td><?= $model->updated_at ?> by <?= $model->updatedBy->username ?></td>
                </tr>
            <?php endif; ?>
            <?php if (!empty($model->deleted_by)): ?>
                <tr>
                    <th><?= $model->getAttributeLabel('deleted_at') ?></th>
                    <td><?= $model->deleted_at ?> by <?= $model->deletedBy->username ?></td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</div>
