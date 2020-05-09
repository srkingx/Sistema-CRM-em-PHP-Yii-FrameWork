<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cargo */
/* @var $form yii\widgets\ActiveForm */


?>

<?php $form = ActiveForm::begin(['id' => 'form-cargo']); ?>
<div class="modal-body">
    <?php if (Yii::$app->user->isSuperadmin) : ?>
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'fk_entidade')->widget(\kartik\select2\Select2::className(), [
                    'theme' => 'bootstrap',
                    'language' => 'pt-BR',
                    'options' => ['placeholder' => 'Entidade'],
                    'initValueText' => empty($model->fk_entidade) ? '' : $model->fkEntidade->nome,
                    'pluginOptions' => [
                        'minimumInputLength' => 1,
                        'ajax' => [
                            'url' => \yii\helpers\Url::to(['entidade/busca-ajax']),
                            'dataType' => 'json',
                            'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }')
                        ],
                    ],
                ])->label('Entidade') ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button id="close-cargo" type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
    <?php \demogorgorn\ajax\AjaxSubmitButton::begin([
        'label' => 'Criar',
        'useWithActiveForm' => 'form-cargo',
        'ajaxOptions' => [
            'type' => 'POST',
            'data' => new \yii\web\JsExpression('new FormData($("#form-cargo")[0])'),
            'processData' => false,
            'contentType' => false,
            'url' => \yii\helpers\Url::to(['//cargo/create']),
            'beforeSend' => new \yii\web\JsExpression('function(){$(".preloader").fadeIn();}'),
            'success' => new \yii\web\JsExpression('
                function(data){
                    var retorno = JSON.parse(data); 
                    if(retorno.status == 200){
                                                
                        $.toast({
                            text: \'Salvo com sucesso\',
                            position: \'top-right\',
                            loaderBg:\'#ff6849\',
                            icon: \'success\',
                            hideAfter: 3000, 
                        });
                        
                        $("#contatocliente-fk_cargo").append("<option value=\'"+retorno.id+"\'>"+retorno.text+"</option>").val(retorno.id).trigger("change");
                        
                        $("#form-cargo input, #form-cargo select, #form-cargo textarea").val(\'\').trigger("change");
                        $("#form-cargo").yiiActiveForm(\'resetForm\');
                        $("#modal-add-cargo").modal("hide");
                        $("#contato-modal").modal("show");
                    } else {
                        $(\'#modal-add-cargo\').find(\'.modal-ajax\').html(retorno.content);
                    }
                    $(".preloader").fadeOut();
                }'
            ),
        ],
        'options' => ['class' => 'btn btn-success', 'type' => 'submit'],
    ]);
    \demogorgorn\ajax\AjaxSubmitButton::end();
    ?>
</div>
<?php ActiveForm::end(); ?>
