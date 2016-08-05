<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Compras */

$this->title = 'Create Compras';
$this->params['breadcrumbs'][] = ['label' => 'Compras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compras-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
         'modelsComprado' => $modelsComprado,
         'proveedores' => $proveedores,
         'productos' => $productos,
    ]) ?>

</div>
