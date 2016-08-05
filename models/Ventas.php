<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ventas".
 *
 * @property integer $id
 * @property integer $folio
 * @property integer $id_cliente
 * @property integer $piezas
 * @property string $subtotal
 * @property string $iva
 * @property string $total
 * @property string $ventascol
 *
 * @property Vendido[] $vendidos
 */
class Ventas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ventas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['folio', 'id_cliente', 'piezas'], 'integer'],
            [['subtotal', 'iva', 'total'], 'number'],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'folio' => 'Folio',
            'id_cliente' => 'Id Cliente',
            'piezas' => 'Piezas',
            'subtotal' => 'Subtotal',
            'iva' => 'Iva',
            'total' => 'Total',
        
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendidos()
    {
        return $this->hasMany(Vendido::className(), ['id_ventas' => 'id']);
    }
}
