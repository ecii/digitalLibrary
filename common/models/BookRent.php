<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "book_rent".
 *
 * @property int $id_book_rent
 * @property int $rent_record_id
 * @property int $book_id
 * @property int $penalty_id
 * @property string $created_at
 * @property int $created_by
 *
 * @property Book $book
 * @property Penalty $penalty
 * @property RentRecord $rentRecord
 */
class BookRent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book_rent';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rent_record_id', 'book_id', 'penalty_id', 'created_at', 'created_by'], 'required'],
            [['rent_record_id', 'book_id', 'penalty_id', 'created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::class, 'targetAttribute' => ['book_id' => 'id_book']],
            [['rent_record_id'], 'exist', 'skipOnError' => true, 'targetClass' => RentRecord::class, 'targetAttribute' => ['rent_record_id' => 'id_rent_record']],
            [['penalty_id'], 'exist', 'skipOnError' => true, 'targetClass' => Penalty::class, 'targetAttribute' => ['penalty_id' => 'id_penalty']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_book_rent' => 'Id Book Rent',
            'rent_record_id' => 'Rent Record ID',
            'book_id' => 'Book ID',
            'penalty_id' => 'Penalty ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::class, ['id_book' => 'book_id']);
    }

    /**
     * Gets query for [[Penalty]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPenalty()
    {
        return $this->hasOne(Penalty::class, ['id_penalty' => 'penalty_id']);
    }

    /**
     * Gets query for [[RentRecord]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRentRecord()
    {
        return $this->hasOne(RentRecord::class, ['id_rent_record' => 'rent_record_id']);
    }
}
