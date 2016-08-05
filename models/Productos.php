<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productos".
 *
 * @property integer $id_producto
 * @property string $nombre_del_producto
 * @property string $categoria
 * @property string $marcas
 * @property double $precio_unitario
 * @property string $estatus
 * @property string $foto
 * @property string $existencias
 */
class Productos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_del_producto', 'categoria', 'marcas', 'precio_unitario', 'estatus', 'foto', 'existencias'], 'required'],
            [['precio_unitario'], 'number'],
            [['nombre_del_producto', 'categoria', 'marcas'], 'string', 'max' => 70],
            [['estatus'], 'string', 'max' => 2],
            [['foto'], 'string', 'max' => 100],
            [['existencias'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_producto' => 'Id Producto',
            'nombre_del_producto' => 'Nombre Del Producto',
            'categoria' => 'Categoria',
            'marcas' => 'Marcas',
            'precio_unitario' => 'Precio Unitario',
            'estatus' => 'Estatus',
            'foto' => 'Foto',
            'existencias' => 'Existencias',
        ];
    }
}
