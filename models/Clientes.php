<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clientes".
 *
 * @property integer $id_cliente
 * @property string $nombre
 * @property string $rfc
 * @property string $correo
 * @property string $direccion
 * @property integer $telefono
 */
class Clientes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clientes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'rfc', 'correo', 'direccion', 'telefono'], 'required'],
            [['telefono'], 'integer'],
            [['nombre', 'correo', 'direccion'], 'string', 'max' => 100],
            [['rfc'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cliente' => 'Id Cliente',
            'nombre' => 'Nombre',
            'rfc' => 'RFC',
            'correo' => 'Correo',
            'direccion' => 'Dirección',
            'telefono' => 'Teléfono',
        ];
    }
}
