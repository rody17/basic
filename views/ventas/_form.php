<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Ventas */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="ventas-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'folio')->textInput() ?>

    <?= $form->field($model, 'id_cliente')->dropDownList($clientes, ['prompt' => 'Seleccionar...']) ?>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Vendido</h4></div>
            <div class="panel-body">
                 <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    //'limit' => 4, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $modelsVendido[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'id_producto',
                        'cantidad',
                        'precio_unitario',
                        'importe'
                    ],
                ]); ?>

                <div class="container-items">
                <?php foreach ($modelsVendido as $i => $modelVendido): ?>
                    <div class="item panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Vendido</h3>
                            <div class="pull-right">
                                <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                                if (! $modelVendido->isNewRecord) {
                                    echo Html::activeHiddenInput($modelVendido, "[{$i}]id");
                                }
                            ?>
                            <?= $form->field($modelVendido, "[{$i}]id_producto")->dropDownList(
                                    $productos,
                                    [
                                        'prompt' => 'Seleccionar...',
                                        'onchange' => '$.get( "'.Url::toRoute('/productos/productoajax').'", { clave:$(this).val(), nitem:$(this).attr("id").replace(/[^0-9.]/g, "") } )
                                                .done(function( data ) {
                                                    if(data.error) {
                                                        alert(data.error);
                                                    } else {
                                                        $("#vendido-" + data.nitem + "-cantidad").val("1");
                                                        $("#vendido-" + data.nitem + "-precio_unitario").val(data.precio);
                                                        $("#vendido-" + data.nitem + "-importe").val(data.precio);
                                                    }
                                                }
                                            );'
                                    ]
                                )
                            ?>
                            <div class="row">
                                <div class="col-sm-4">
                                    <?= $form->field($modelVendido, "[{$i}]cantidad")->textInput([
                                        'maxlength' => true,
                                        'onblur' => 'cerrarItem( $(this) )'
                                    ]) ?>
                                </div>

                                <div class="col-sm-4">
                                    <?= $form->field($modelVendido, "[{$i}]precio_unitario")->textInput(['maxlength' => true]) ?>
                                </div>

                                <div class="col-sm-4">
                                    <?= $form->field($modelVendido, "[{$i}]importe")->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>

                <?php DynamicFormWidget::end(); ?>
            </div>
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

<script type="text/javascript">
    function cerrarItem(item) {
        var noItem     = itemNo(item.attr("id"));
        var qty        = amount($("#vendido-" + noItem + "-cantidad").val());

        var precio     = amount($("#vendido-" + noItem + "-precio_unitario").val());
        var importe    = qty * precio;

        $("#vendido-" + noItem + "-importe").val(importe.toFixed(4));

        cerrar();
    }

    function cerrar() {
        var nArtic = amount($("#ventas-piezas").val());

        var sumCantidad = 0;
        var sumSubtotal = 0;
        var sumIVA      = 0;
        var sumTotal    = 0;

        for (i=0; i < nArtic; i++) {
            sumCantidad += amount($(".dynamicform_wrapper").find("#vendido-"+i+"-cantidad").val());
            sumSubtotal += amount($(".dynamicform_wrapper").find("#vendido-"+i+"-cantidad").val()) *
                            amount($(".dynamicform_wrapper").find("#vendido-"+i+"-precio_unitario").val());
            sumTotal    += amount($(".dynamicform_wrapper").find("#vendido-"+i+"-importe").val());
        }

        $("#ventas-piezas").val(sumCantidad);
        $("#ventas-subtotal").val(sumSubtotal.toFixed(4));
        $("#ventas-iva").val(sumIVA.toFixed(4));
        $("#ventas-total").val(sumTotal.toFixed(4));
    }

    function amount(value) {
        if (value == "")
            return 0.00;
        else
            return parseFloat(value.replace(/,/g, ""));
    }

    function itemNo(itemID) {
        var noItem = itemID.replace(/[^0-9.]/g, "");
        return noItem;
    }
</script>
