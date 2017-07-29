<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "City".
 *
 * @property int $id
 * @property string $Name
 * @property string $CountryCode
 * @property string $District
 * @property int $Population
 * @property int $Language_id
 *
 * @property Country $countryCode
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'City';
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
            [['Name', 'CountryCode', 'District', 'Language_id'],'required'],
            [['Population'], 'integer'],
            [['Population'], 'default', 'value' => 0],
            [['Name'], 'string', 'max' => 35],
            [['CountryCode'], 'string', 'max' => 3],
            [['District'], 'string', 'max' => 20],
            [['CountryCode'], 'string'],
            [['CountryCode'], 'exist', 'skipOnError' => false, 'targetClass' => Country::className(), 'targetAttribute' => ['CountryCode' => 'Code']],
            [['Language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Languag::className(), 'targetAttribute' => ['Language_id' => 'id']],
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
            'CountryCode' => Yii::t('app', 'Country'),
            'District' => Yii::t('app', 'District'),
            'Population' => Yii::t('app', 'Population'),
            'Language_id' => Yii::t('app', 'Language'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['Code' => 'CountryCode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Languag::className(), ['id' => 'Language_id']);
    }
}
