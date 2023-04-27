<?php

namespace common\models;

use DateTime;

use Yii;

/**
 * This is the model class for table "penalty".
 *
 * @property int $id_penalty
 * @property int $price_id
 * @property int $charge
 * @property int $duration
 * @property string $created_at
 * @property int $created_by
 *
 * @property BookRent[] $bookRents
 * @property PenaltyPrice $price
 */
class Penalty extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penalty';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price_id', 'charge', 'duration', 'created_at', 'created_by'], 'required'],
            [['price_id', 'charge', 'duration', 'created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['price_id'], 'exist', 'skipOnError' => true, 'targetClass' => PenaltyPrice::class, 'targetAttribute' => ['price_id' => 'id_price']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_penalty' => 'Id Penalty',
            'price_id' => 'Price ID',
            'charge' => 'Charge',
            'duration' => 'Duration',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * Gets query for [[BookRents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookRents()
    {
        return $this->hasMany(BookRent::class, ['penalty_id' => 'id_penalty']);
    }

    /**
     * Gets query for [[Price]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrice()
    {
        return $this->hasOne(PenaltyPrice::class, ['id_price' => 'price_id']);
    }

    public function hitungDenda($id_rent_record){
        
        $data = BookRent::find()->where($id_rent_record)->all();
        foreach($data as $array){
            
            $tglP=$array->rentRecord->created_at;
            $tglK=$array->rentRecord->return_at;
            
            $tglPinjam=new DateTime($tglP);
            $tglKembali=new DateTime($tglK);

            $selisih=$tglKembali->diff($tglPinjam);

            $hari=$selisih->d;
            $lamaHari=$hari-7;
            $denda=$lamaHari*2000;

            return $denda;
        }
    }

    public function lamaPeminjaman($id_rent_record){
        $data = BookRent::find()->where($id_rent_record)->all();
        foreach($data as $array){
            
            $tglP=$array->rentRecord->created_at;
            $tglK=$array->rentRecord->return_at;
            
            $tglPinjam=new DateTime($tglP);
            $tglKembali=new DateTime($tglK);

            $selisih=$tglKembali->diff($tglPinjam);

            $hari=$selisih->d;
            $lamaHari=$hari;
            

            return $lamaHari;
        }
    }

    public function lamaDenda($id_rent_record){
        $data = BookRent::find()->where($id_rent_record)->all();
        foreach($data as $array){
            
            $tglP=$array->rentRecord->created_at;
            $tglK=$array->rentRecord->return_at;
            
            $tglPinjam=new DateTime($tglP);
            $tglKembali=new DateTime($tglK);

            $selisih=$tglKembali->diff($tglPinjam);

            $hari=$selisih->d;
            $lamaHari=$hari-7;
            

            return $lamaHari;
        }

    }

    public function totalHarga($id_rent_record){
        return BookRent::find()->where($id_rent_record)->sum('penalty_id');
    }
}
