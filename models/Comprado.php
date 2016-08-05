<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comprado".
 *
 * @property integer $id
 * @property integer $id_compras
 * @property integer $id_producto
 * @property integer $cantidad
 * @property string $costo_unitario
 * @property string $importe
 */
class Comprado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comprado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_compras', 'id_producto', 'cantidad', 'costo_unitario', 'importe'], 'required'],
            [['id_compras', 'id_producto', 'cantidad'], 'integer'],
            [['costo_unitario', 'importe'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_compras' => 'Id Compras',
            'id_producto' => 'Id Producto',
            'cantidad' => 'Cantidad',
            'costo_unitario' => 'Costo Unitario',
            'importe' => 'Importe',
        ];
    }
}
