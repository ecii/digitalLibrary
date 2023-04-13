<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id_profile
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $birthday
 * @property string $gender
 * @property int $married
 * @property string $address
 * @property int $job_id
 * @property string $created_at
 * @property int $created_by
 *
 * @property Job $job
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'birthday', 'gender', 'married', 'address', 'job_id', 'created_at', 'created_by'], 'required'],
            [['birthday', 'created_at'], 'safe'],
            [['gender', 'address'], 'string'],
            [['married', 'job_id', 'created_by'], 'integer'],
            [['name', 'email'], 'string', 'max' => 225],
            [['phone'], 'string', 'max' => 20],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Job::class, 'targetAttribute' => ['job_id' => 'id_job']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_profile' => 'Id Profile',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'birthday' => 'Birthday',
            'gender' => 'Gender',
            'married' => 'Married',
            'address' => 'Address',
            'job_id' => 'Job ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * Gets query for [[Job]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMyJob()
    {
        return $this->hasOne(Job::class, ['id_job' => 'job_id']);
    }
}
