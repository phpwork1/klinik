<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = $model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'][] = Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['update', <?= $urlParams ?>], ['class' => 'btn btn-warning']);
$this->params['buttons'][] = Html::a('<i class="glyphicon glyphicon-remove"></i> ', ['delete', <?= $urlParams ?>], [
'class' => 'btn btn-danger',
'data' => [
'confirm' => <?= $generator->generateString('Are you sure you want to delete this item?') ?>,
'method' => 'post',
],
]);
?>
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title"><?= "<?= " ?>Html::encode($this->title) ?></h3>
    </div>

    <div class="box-body event-type-form table-responsive">
        <table class="table table-hover table-striped detail-view">
<?php if (($tableSchema = $generator->getTableSchema()) === false): ?>
    <?php foreach ($generator->getColumnNames() as $name): ?>
        <tr>
                <th><?= "<?= \$model->getAttributeLabel('$name') ?>" ?></th>
                <td><?= "<?= \$model->$name ?>" ?></td>
            </tr>
    <?php endforeach; ?>
<?php else: ?>
    <?php foreach ($generator->getColumnNames() as $name): ?>
        <tr>
                <th><?= "<?= \$model->getAttributeLabel('$name') ?>" ?></th>
                <td><?= "<?= \$model->$name ?>" ?></td>
            </tr>
    <?php endforeach; ?>
<?php endif; ?>
        </table>
    </div>
</div>
