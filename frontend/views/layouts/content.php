<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;
//use common\widgets\Alert;

use backend\models\Parameter;

/* @var $content string */

?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="pull-left">
            <?=
            Breadcrumbs::widget([
                'homeLink' => ['label' => '<i class="glyphicon glyphicon-home"></i>', 'encode' => false, 'url' => ['/site/index']],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
        </div>

        <div class="pull-right">
            <?php if (isset($this->blocks['content-header'])) { ?>
                <h1><?= $this->blocks['content-header'] ?></h1>
            <?php } else { ?>
                <div class="btn-group">
                    <?php
                    if (isset($this->params['buttons'])):
                        foreach ($this->params['buttons'] as $button):
                            echo $button . '&nbsp;';
                        endforeach;
                    endif;
                    ?>
                </div>
                <div class="btn-group">
                    <?php
                    if (isset($this->params['export'])):
                        echo $this->params['export'];
                    endif;
                    ?>
                </div>
            <?php } ?>
        </div>

        <div class="clearfix"></div>
    </section>

    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>

<footer class="main-footer">
    <strong>Copyright &copy; 2017 <a href="http://evnzer.com">Tonny Sofijan</a>.</strong>
</footer>
