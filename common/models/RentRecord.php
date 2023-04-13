<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rent_record".
 *
 * @property int $id_rent_record
 * @property int $profile_id
 * @property string $return_at
 * @property string $rent_status
 * @property string $created_at
 * @property string $created_by
 *
 * @property Profile $profile
 * @property BookRent $rentRecord
 */
class RentRecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rent_record';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['profile_id','rent_status', 'created_at', 'created_by'], 'required'],
            [['profile_id'], 'integer'],
            [['return_at', 'created_at', 'created_by'], 'safe'],
            [['rent_status'], 'string'],
            [['id_rent_record'], 'exist', 'skipOnError' => true, 'targetClass' => BookRent::class, 'targetAttribute' => ['id_rent_record' => 'id_book_rent']],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['profile_id' => 'id_profile']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_rent_record' => 'Id Rent Record',
            'profile_id' => 'Profile ID',
            'return_at' => 'Return At',
            'rent_status' => 'Rent Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['id_profile' => 'profile_id']);
    }

    /**
     * Gets query for [[RentRecord]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRentRecord()
    {
        return 
        $this->hasOne(BookRent::class, ['id_book_rent' => 'id_rent_record'])
        ;

    }

    public function jumPeminjaman(){
        return RentRecord::find()->where(['rent_status'=>'RENT'])->count();
    }
}
