<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "Package".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property double $price
 * @property int $duration
 * @property string $duaration_unit
 * @property int $weight
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Job[] $jobs
 */
class Package extends \yii\db\ActiveRecord
{
    const DURATION_UNITS = ['H' => 'Hour', 'D' => 'Day', 'M' => 'Month', 'Y' => 'Year'];
    const VISIBILITY = [
        0 => 'No', 
        1 => 'Yes'
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Package';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title' , 'description', 'price', 'duration', 'duaration_unit', 'weight'], 'required'],
            [['price'], 'number'],
            [['duration', 'weight', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],
            [['duaration_unit'], 'string', 'max' => 20],
            [['visible'],'default', 'value' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'duration' => Yii::t('app', 'Duration'),
            'duaration_unit' => Yii::t('app', 'Duaration Unit'),
            'weight' => Yii::t('app', 'Weight'),
            'visible' => Yii::t('app', 'Visible'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public static function find() {
        if(
            Yii::$app->controllerNamespace == 'backend\controllers' || 
            (Yii::$app->controllerNamespace == 'api\controllers' && 
            Yii::$app->controller->id == 'favorite' && 
            Yii::$app->controller->action->id == 'create')
        )
            return parent::find();

        return parent::find()->where(['visible' => 1]);;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobs()
    {
        return $this->hasMany(Job::className(), ['package_id' => 'id']);
    }
}
