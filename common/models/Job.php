<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "job".
 *
 * @property int $id_job
 * @property string $job_name
 * @property string $job_category
 * @property int $pns
 * @property string $description
 * @property string $created_at
 * @property int $created_by
 *
 * @property Profile[] $profiles
 */
class Job extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job_name', 'job_category', 'pns', 'description', 'created_at', 'created_by'], 'required'],
            [['job_category', 'description'], 'string'],
            [['pns', 'created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['job_name'], 'string', 'max' => 225],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_job' => 'Id Job',
            'job_name' => 'Job Name',
            'job_category' => 'Job Category',
            'pns' => 'Pns',
            'description' => 'Description',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * Gets query for [[Profiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles() //get itu artinya relasi (getProfile = berelasi dengan tabel profile)
    {
        return $this->hasMany(Profile::class, ['job_id' => 'id_job']);
    }

    public static function listJob(){
        $data = Job::find()->all(); //select * from tabel pekerjaan 
        //kalau ada :: berarti dy model (object)
        $array_job= ArrayHelper::map($data,'id_job','job_name'); // arry helper membuat arry dari objk
        return $array_job;
    }
}
