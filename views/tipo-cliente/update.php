<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoCliente */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipos Cliente'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->descricao, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
$this->title = 'Atualizar';
?>
<div class="tipo-cliente-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
