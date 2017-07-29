<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "Country".
 *
 * @property string $Code
 * @property string $Name
 * @property string $Continent
 * @property string $Region
 * @property double $SurfaceArea
 * @property int $IndepYear
 * @property int $Population
 * @property double $LifeExpectancy
 * @property double $GNP
 * @property double $GNPOld
 * @property string $LocalName
 * @property string $GovernmentForm
 * @property string $HeadOfState
 * @property int $Capital
 * @property string $Code2
 * @property int $created_at
 * @property int $updated_at
 * @property int $Language_id
 *
 * @property Languag $Language_id
 * @property City[] $cities
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Country';
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
            [['Code', 'Name'], 'required'],
            [['Continent'], 'string'],
            [['Continent'], 'default', 'value' => 'Asia'],
            [['SurfaceArea', 'LifeExpectancy', 'GNP', 'GNPOld'], 'number'],
            [['SurfaceArea', 'LifeExpectancy', 'GNP', 'GNPOld'], 'default', 'value' => 0],
            [['IndepYear', 'Population', 'Capital', 'created_at', 'updated_at'], 'integer'],
            [['IndepYear', 'Population', 'Capital', 'created_at', 'updated_at'], 'default', 'value' => 0],
            [['Code'], 'string', 'max' => 3],
            [['Name'], 'string', 'max' => 100],
            [['Region'], 'string', 'max' => 26],
            [['LocalName', 'GovernmentForm'], 'string', 'max' => 45],
            [['HeadOfState'], 'string', 'max' => 60],
            [['Code2'], 'string', 'max' => 2],
            [['Code'], 'unique'],
            [['Language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Languag::className(), 'targetAttribute' => ['Language_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Code' => Yii::t('app', 'Code'),
            'Name' => Yii::t('app', 'Name'),
            'Continent' => Yii::t('app', 'Continent'),
            'Region' => Yii::t('app', 'Region'),
            'SurfaceArea' => Yii::t('app', 'Surface Area'),
            'IndepYear' => Yii::t('app', 'Indep Year'),
            'Population' => Yii::t('app', 'Population'),
            'LifeExpectancy' => Yii::t('app', 'Life Expectancy'),
            'GNP' => Yii::t('app', 'Gnp'),
            'GNPOld' => Yii::t('app', 'Gnpold'),
            'LocalName' => Yii::t('app', 'Local Name'),
            'GovernmentForm' => Yii::t('app', 'Government Form'),
            'HeadOfState' => Yii::t('app', 'Head Of State'),
            'Capital' => Yii::t('app', 'Capital'),
            'Code2' => Yii::t('app', 'Code2'),
            'Language_id' => Yii::t('app', 'Language'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['CountryCode' => 'Code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Languag::className(), ['id' => 'Language_id']);
    }
}
