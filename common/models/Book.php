<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "book".
 *
 * @property int $id_book
 * @property string $title
 * @property string $author
 * @property string $publisher
 * @property string $year
 * @property string $description
 * @property string $created_at
 * @property string $created_by
 *
 * @property BookRent[] $bookRents
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'author', 'publisher', 'year', 'description', 'created_at', 'created_by'], 'required'],
            [['year', 'created_at', 'created_by'], 'safe'],
            [['description'], 'string'],
            [['title', 'author', 'publisher'], 'string', 'max' => 225],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_book' => 'Id Book',
            'title' => 'Title',
            'author' => 'Author',
            'publisher' => 'Publisher',
            'year' => 'Year',
            'description' => 'Description',
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
        return $this->hasMany(BookRent::class, ['rent_record_id' => 'id_book']);
    }

    public static function listBook(){
        $data = Book::find()->all(); //select * from tabel Book 
        //kalau ada :: berarti dy model (object)
        $array_book= ArrayHelper::map($data,'id_book','title'); // arry helper membuat arry dari objk
        return $array_book;
    }
    public function hitungKali($num1,$num2,$num3){
        $hasil=$num1*$num2*$num3;
        return $hasil;
    }

    public static function listBookIndex(){
        //return Book::find()->where(['year'=>'2020','id'=>1])->all();
        return Book::find()->all();
    }

    public function jumPinjam(){
        return BookRent::find()->where(['book_id'=>$this->id_book])->count();
    }

    public function jumBuku(){
       return Book::find()->count();
    }


   
}
