<?php

namespace common\models;

use Yii;

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
 * @property string $updated_at
 *
 * @property Job[] $jobs
 */
class Package extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Package';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','price','duration','duration_unit'], 'required'],
            [['price'], 'number'],
            [['duration', 'weight'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],
            [['duaration_unit'], 'string', 'max' => 20]
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
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJobs()
    {
        return $this->hasMany(Job::className(), ['package_id' => 'id']);
    }
}
