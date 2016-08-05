<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proveedores".
 *
 * @property integer $id_pro
 * @property string $nombre
 * @property string $direccion
 * @property string $correo
 * @property string $rfc
 */
class Proveedores extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proveedores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'direccion', 'correo', 'rfc'], 'required'],
            [['nombre', 'direccion', 'correo'], 'string', 'max' => 100],
            [['rfc'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_pro' => 'Id Pro',
            'nombre' => 'Nombre',
            'direccion' => 'Dirección',
            'correo' => 'Correo',
            'rfc' => 'RFC',
        ];
    }
}
