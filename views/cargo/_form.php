<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cargo */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs("
    function clearHideInput(id) {
        $(id).parents('.form-group').parent().addClass('hide');
        $(id).val('').change();
    }
    
    function clearShowInput(id) {
        $(id).parents('.form-group').parent().removeClass('hide');
        $(id).val('').change();
    }
", \yii\web\View::POS_HEAD);
?>

<div class="cargo-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
            <?php if(Yii::$app->user->isSuperadmin){?>
                <?= $form->field($model, 'fk_entidade')->widget(\kartik\select2\Select2::className(), [
                    'theme' => 'bootstrap',
                    'language' => 'pt-BR',
                    'options' => ['placeholder' => 'Empresa'],
                    'initValueText' => empty($model->fk_entidade) ? '' : $model->fkEntidade->razao_social,
                    'pluginOptions' => [
                        'minimumInputLength' => 1,
                        'ajax' => [
                            'url' => \yii\helpers\Url::to(['entidade/busca-ajax']),
                            'dataType' => 'json',
                            'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }')
                        ],
                    ],
                ])->label('Empresa') ?>
            <?php } ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
