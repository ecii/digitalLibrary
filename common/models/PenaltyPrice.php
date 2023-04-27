<?php

namespace common\models;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "penalty_price".
 *
 * @property int $id_price
 * @property int $price_tag
 * @property string $status
 * @property string $created_at
 * @property int $created_by
 *
 * @property Penalty[] $penalties
 */
class PenaltyPrice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penalty_price';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price_tag', 'status', 'created_at', 'created_by'], 'required'],
            [['price_tag', 'created_by'], 'integer'],
            [['status'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_price' => 'Id Price',
            'price_tag' => 'Price Tag',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * Gets query for [[Penalties]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPenalties()
    {
        return $this->hasMany(Penalty::class, ['price_id' => 'id_price']);
    }

    public static function listPenaltyPrice(){
        $data = PenaltyPrice::find()->all(); //select * from tabel pekerjaan 
        //kalau ada :: berarti dy model (object)
        $array_PenaltyPrice= ArrayHelper::map($data,'id_price','status'); 
        // arry helper membuat arry dari objk
        
        return $array_PenaltyPrice;
    }
}
