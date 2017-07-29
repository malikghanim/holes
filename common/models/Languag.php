<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Languag".
 *
 * @property int $id
 * @property string $Name
 * @property string $iso_639-1
 * @property int $created_at
 * @property int $updated_at
 *
 * @property City[] $cities
 * @property Country[] $countries
 */
class Languag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Languag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'iso_639-1', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['Name'], 'string', 'max' => 50],
            [['iso_639-1'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'Name' => Yii::t('app', 'Name'),
            'iso_639-1' => Yii::t('app', 'Iso 639 1'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['Language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountries()
    {
        return $this->hasMany(Country::className(), ['Language_id' => 'id']);
    }
}
