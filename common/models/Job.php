<?php

namespace common\models;

use Yii;
use yiimodules\categories\models\Categories;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "Job".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $mobile
 * @property int $working_from
 * @property int $working_to
 * @property int $category_id
 * @property string $CountryCode
 * @property int $city_id
 * @property int $user_id
 *
 * @property Country $countryCode
 * @property YmdCategories $category
 * @property City $city
 * @property User $user
 */
class Job extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Job';
    }

    /**
     * @inheritdoc
     */
    public static function primaryKey()
    {
        return ['id'];
    }

    /**
     * @inheritdoc
     */
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
            [
                [
                    'title',
                    'category_id',
                    'city_id',
                    'working_from' ,
                    'working_to',
                    'mobile'
                ], 'safe'
            ],
            [
                [
                    'title',
                    'category_id',
                    'city_id',
                    'working_from' ,
                    'working_to',
                    'mobile'
                ], 'required'
            ],
            [
                [
                    'working_from',
                    'working_to',
                    'category_id',
                    'city_id',
                    'user_id'
                ], 'integer'
            ],
            [['title'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],
            [['mobile'], 'string', 'max' => 20],
            [['CountryCode'], 'string', 'max' => 3],
            [['CountryCode'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['CountryCode' => 'Code']
            ],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']
            ],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']
            ],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']
            ],
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
            'mobile' => Yii::t('app', 'Mobile'),
            'working_from' => Yii::t('app', 'Working From'),
            'working_to' => Yii::t('app', 'Working To'),
            'category_id' => Yii::t('app', 'Category ID'),
            'CountryCode' => Yii::t('app', 'Country Code'),
            'city_id' => Yii::t('app', 'City ID'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->user_id = Yii::$app->user->identity->id;
                $this->CountryCode = $this->city->country->Code;
            }

            return true;
        }
    }

    function fields(){
        $data = [];
        foreach ($this->getAttributes() as $key => $value) {
            if($key == 'user_id'){
                $data['available'] = function(){
                    return true;
                };

                $data['userinfo'] = function(){
                    return $this->user;
                };
            }

            $data[] = $key;
        }

        return $data;
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
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackage()
    {
        return $this->hasOne(Package::className(), ['id' => 'package_id']);
    }
}
