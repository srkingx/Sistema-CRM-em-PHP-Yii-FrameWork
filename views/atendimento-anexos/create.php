<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AtendimentoAnexos */

$this->title = 'Create Atendimento Anexos';
$this->params['breadcrumbs'][] = ['label' => 'Atendimento Anexos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atendimento-anexos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
