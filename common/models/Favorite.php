<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii2tech\ar\softdelete\SoftDeleteBehavior;
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
            [['active'], 'default', 'value' => 0],
            [['package_id','job_id','user_id','active'], 'filter', 'filter' => 'intval'],
            [['is_deleted'], 'default', 'value' => false],
            [['active'], 'validateActiveExist']

        ];
    }


    public function validateActiveExist($attribute)
    {
        if ($this->$attribute == 1) {
            $activeFavorate = Favorite::find()->where([
                'job_id' => $this->job_id,
                'active' => 1
            ])->all();

            if (!empty($activeFavorate)) {
                $this->addError($attribute, 'This job has an active favorate already!');
                return false;
            }
        }

        return true;
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
            'is_deleted' => Yii::t('app', 'Is Deleted'),
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
            ],
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'is_deleted' => true
                ],
            ],
        ];
    }

    public static function find()
    {
        $query = parent::find()->where(['is_deleted' => 0]);
        return $query;
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

    public function delete() {
        $this->job->favorite = 0;
        $this->job->weight = 0;
        $this->job->save();

        $this->active = 3;
        $this->save();

        $this->softDelete();
        return true;
    }
}
