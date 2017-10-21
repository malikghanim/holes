<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "Favorite".
 *
 * @property int $id
 * @property int $package_id
 * @property int $job_id
 * @property int $user_id
 * @property int $start_date
 * @property int $end_date
 * @property int $weight
 * @property int $active
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Job $job
 * @property Package $package
 * @property User $user
 */
class Favorite extends \yii\db\ActiveRecord
{
    const STATUSES = [
        0 => 'Pending', 
        1 => 'Active',
        2 => 'Reject',
        3 => 'Expire'
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Favorite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['package_id', 'job_id'], 'required'],
            [['package_id', 'job_id', 'user_id', 'start_date', 'end_date', 'weight', 'active', 'created_at', 'updated_at'], 'integer'],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Job::className(), 'targetAttribute' => ['job_id' => 'id']],
            [['package_id'], 'exist', 'skipOnError' => true, 'targetClass' => Package::className(), 'targetAttribute' => ['package_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['active'], 'default', 'value' => 0]

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'package_id' => Yii::t('app', 'Package ID'),
            'job_id' => Yii::t('app', 'Job ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
            'weight' => Yii::t('app', 'Weight'),
            'active' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function() { return date('U');},
            ]
        ];
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->user_id = $this->job->user->id;
            }

            if (empty($this->start_date) && $this->active == 1)
                $this->start_date = date('U');

            if (empty($this->end_date) && $this->active == 1) {
                $date = new \DateTime();
                $timeFlag = ($this->package->duaration_unit == 'H')? 'T':'';
                $interval = new \DateInterval("P{$timeFlag}{$this->package->duration}{$this->package->duaration_unit}");
                $date->add($interval);
                $this->end_date = $date->format('U');
                // Update Job
                $this->job->favorite = 1;
                $this->job->weight = $this->package->weight;
                $this->job->fav_start_date = $this->start_date;
                $this->job->fav_end_date = $this->end_date;
                $this->job->save();
            }

            return true;
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJob()
    {
        return $this->hasOne(Job::className(), ['id' => 'job_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobTitle()
    {
        if (!empty($this->job))
            return $this->job->title;
        else
            return null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackage()
    {
        return $this->hasOne(Package::className(), ['id' => 'package_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
