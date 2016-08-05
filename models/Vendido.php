<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vendido".
 *
 * @property integer $id
 * @property integer $id_ventas
 * @property integer $id_producto
 * @property integer $cantidad
 * @property string $precio_unitario
 * @property string $importe
 *
 * @property Ventas $idVentas
 */
class Vendido extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vendido';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ventas', 'id_producto', 'cantidad'], 'integer'],
            [['precio_unitario', 'importe'], 'number'],
            [['id_ventas'], 'exist', 'skipOnError' => true, 'targetClass' => Ventas::className(), 'targetAttribute' => ['id_ventas' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ventas' => 'Id Ventas',
            'id_producto' => 'Id Producto',
            'cantidad' => 'Cantidad',
            'precio_unitario' => 'Precio Unitario',
            'importe' => 'Importe',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdVentas()
    {
        return $this->hasOne(Ventas::className(), ['id' => 'id_ventas']);
    }
}
