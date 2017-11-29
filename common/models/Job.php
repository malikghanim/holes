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
 * @property int $status
 * @property int $favorite
 * @property int $fav_start_date
 * @property int $fav_end_date
 * @property int $weight
 *
 * @property Country $countryCode
 * @property YmdCategories $category
 * @property City $city
 * @property User $user
 */
class Job extends \yii\db\ActiveRecord
{
    const JOB_STATUS = [
        0 => 'Pending',
        1 => 'Active',
        2 => 'Reject'
    ];
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
                    'mobile',
                    'address',
                    'status'
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
            'address' => Yii::t('app', 'Address'),
            'user_id' => Yii::t('app', 'User ID'),
            'status' => Yii::t('app', 'Status'),
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
                $data['userinfo'] = function(){
                    return $this->user;
                };

                $data['city_name'] = function(){
                    return $this->city->Name;
                };

                $data['country_name'] = function(){
                    return $this->city->country->Name;
                };

                $data['category_name'] = function(){
                    return $this->category->name;
                };
            }

            if ($key == 'category_id') {
                $data['available'] = function(){
                    // $today = new \DateTime("now", new \DateTimeZone('Asia/Amman') );

                    // $start = \DateTime::createFromFormat('H:i', $this->working_from);
                    // $start = date('h:i A', strtotime($start->format('H:i')));
                    // $startArry = explode(' ', $start);
                    // $startTimeArray = explode(':', $startArry[0]);
                    // $start = [
                    //     'h' => (int)$startTimeArray[0],
                    //     'i' => (int)$startTimeArray[1],
                    //     'p' => $startArry[1],
                    //     'pw' => ($startArry[1] == 'AM')? 0:12
                    // ];

                    // $end = \DateTime::createFromFormat('H:i', $this->working_to);
                    // $end = date('h:i A', strtotime($end->format('H:i')));
                    // $endArry = explode(' ', $end);
                    // $endTimeArray = explode(':', $endArry[0]);
                    // $end = [
                    //     'h' => (int)$endTimeArray[0],
                    //     'i' => (int)$endTimeArray[1],
                    //     'p' => $endArry[1],
                    //     'pw' => ($endArry[1] == 'AM')? 0:12
                    // ];

                    // $curr = \DateTime::createFromFormat('H:i', $today->format('H:i'));
                    // $curr = date('h:i A', strtotime($curr->format('H:i')));
                    // $currArry = explode(' ', $curr);
                    // $currTimeArray = explode(':', $currArry[0]);
                    // $curr = [
                    //     'h' => (int)$currTimeArray[0],
                    //     'i' => (int)$currTimeArray[1],
                    //     'p' => $currArry[1],
                    //     'pw' => ($currArry[1] == 'AM')? 0:12
                    // ];

                    // $start['count'] = ($start['pw'] + $start['h'] + (($start['i']+1)/100));
                    // $end['count'] = ($end['pw'] + $end['h'] + (($end['i']+1)/100));

                    // $curr['count'] = (($curr['pw'] < $start['pw'])? 12:0) + $curr['h'] + (($curr['i']+1)/100);

                    // $curr['started'] = ( ($curr['count'] > $start['count'] && $start['pw'] == $end['pw']) ||  ($curr['count'] < $start['count'] && $start['pw'] > $end['pw']));

                    // $curr['ended'] = ( ($curr['count'] > $end['count'] && $start['pw'] == $end['pw']) || $curr['count'] < $end['count'] && $start['pw'] > $end['pw']);

                    // $started = false;
                    // $ended = false;
                    // if ($start['pw']==$end['pw'] && $end['pw']==$curr['pw'] && 
                    //     $start['count'] < $end['count'] && 
                    //     $curr['count'] > $start['count']
                    // ) {
                    //     $started = true;
                    // }

                    // if ($start['pw']==$end['pw'] && $end['pw']==$curr['pw'] && 
                    //     $start['count'] > $end['count'] && 
                    //     $curr['count'] < $end['count']
                    // ) {
                    //     $ended = true;
                    // }

                    // if ($start['pw']<$end['pw'] && 
                    //     $start['count'] > $end['count'] && 
                    //     $curr['count'] < $end['count']
                    // ) {
                    //     $ended = true;
                    // }

                    // // $startDef = $curr->diff($start);
                    // // $endDef = $curr->diff($end);
                    // // $workingHours = $start->diff($end);

                    // return [
                    //     'started' => $started,
                    //     'ended' => $ended
                    // ];



                    // if ()
                    //     return true;
                    // else
                    //     return false;
                    return true;
                };
            }

            $data[] = $key;
        }

        return $data;
    }

    public static function find() {
        if(Yii::$app->controllerNamespace == 'backend\controllers')
            return parent::find();

        if (!Yii::$app->user->isGuest)
            return parent::find()->where(['user_id' => Yii::$app->user->identity->id]);

        return parent::find()->where(['status' => 1]);
    }

    public function afterFind()
    {
        if ($this->favorite == 1 && (int)$this->fav_end_date < (int)date('U')) {
            $fav = Favorite::findOne([
                'weight' => $this->weight,
                'start_date' => $this->fav_start_date,
                'end_date' => $this->fav_end_date
            ]);
            if (!empty($fav)) {
                $fav->active = 3;
                $fav->save();
            }
            $this->favorite = 0;
            $this->weight = 0;
            $this->save();
        }

        parent::afterFind();
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavorite()
    {
        return $this->hasMany(Favorite::className(), ['job_id' => 'id'])->where(['active' => 1])->orderBy(['created_at' => SORT_DESC]);
    }
}
