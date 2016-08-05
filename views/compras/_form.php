<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Compras */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="compras-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'folio')->textInput() ?>

    <?= $form->field($model, 'id_proveedor')->dropDownList($proveedores, ['prompt' => 'Seleccionar...']) ?>

<div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Comprado</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsComprado[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'id_producto',
                    'cantidad',
                    'costo_unitario',
                    'importe'
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsComprado as $i => $modelComprado): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Productos</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelComprado->isNewRecord) {
                                echo Html::activeHiddenInput($modelComprado, "[{$i}]id");
                            }
                        ?>
                        <?= $form->field($modelComprado, "[{$i}]id_producto")->dropDownList(
                                $productos,
                                [
                                     'prompt' => 'Seleccionar...',
                                        'onchange' => '$.get( "'.Url::toRoute('/productos/productoajax').'", { clave:$(this).val(), nitem:$(this).attr("id").replace(/[^0-9.]/g, "") } )
                                                .done(function( data ) {
                                                    if(data.error) {
                                                        alert(data.error);
                                                    } else {
                                                        $("#comprado-" + data.nitem + "-cantidad").val("1");
                                                        $("#comprado-" + data.nitem + "-costo_unitario").val(data.costo);
                                                        $("#comprado-" + data.nitem + "-importe").val(data.costo);
                                                    }
                                                }
                                            );'
                                ]
                            ) 
                         ?>

                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($modelComprado, "[{$i}]cantidad")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelComprado, "[{$i}]costo_unitario")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelComprado, "[{$i}]importe")->textInput(['maxlength' => true]) ?>
                            </div>
                            
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <?= $form->field($model, 'piezas')->textInput() ?>

    <?= $form->field($model, 'subtotal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'iva')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
