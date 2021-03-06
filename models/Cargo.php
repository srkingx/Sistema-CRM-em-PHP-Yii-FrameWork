<?php

namespace app\models;

use Yii;
use app\behaviors\RelationDeleteBehavior;
/**
 * This is the model class for table "cargo".
 *
 * @property int $id
 * @property int $fk_entidade
 * @property string $descricao
 *
 * @property Entidade $fkEntidade
 * @property ContatoCliente[] $contatoClientes
 */
class Cargo extends \app\models\MainModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cargo';
    }

    public function behaviors()
    {
        return yii\helpers\ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => RelationDeleteBehavior::className(),
                'relations' => ['contatoClientes']
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['fk_entidade', 'required', 'when' => function(){return Yii::$app->user->isSuperadmin;}],
            ['fk_entidade', 'default', 'value' => Yii::$app->user->entidade, 'when' => function(){return !Yii::$app->user->isSuperadmin;}],
            [['descricao'], 'required', 'enableClientValidation' => false],
            [['fk_entidade'], 'integer'],
            [['descricao'], 'string', 'max' => 50],
            [['fk_entidade'], 'exist', 'skipOnError' => true, 'targetClass' => Entidade::className(), 'targetAttribute' => ['fk_entidade' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_entidade' => 'Empresa',
            'descricao' => 'Descrição',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkEntidade()
    {
        return $this->hasOne(Entidade::className(), ['id' => 'fk_entidade']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContatoClientes()
    {
        return $this->hasMany(ContatoCliente::className(), ['fk_cargo' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\CargoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\CargoQuery(get_called_class());
    }
}
