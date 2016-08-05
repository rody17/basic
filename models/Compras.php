<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "compras".
 *
 * @property integer $id
 * @property integer $folio
 * @property integer $id_proveedor
 * @property integer $piezas
 * @property string $subtotal
 * @property string $iva
 * @property string $total
 */
class Compras extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'compras';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['folio', 'id_proveedor', 'piezas', 'subtotal', 'iva', 'total'], 'required'],
            [['folio', 'id_proveedor', 'piezas'], 'integer'],
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
            'id_proveedor' => 'Id Proveedor',
            'piezas' => 'Piezas',
            'subtotal' => 'Subtotal',
            'iva' => 'Iva',
            'total' => 'Total',
        ];
    }
}
