<?php

namespace admin\models;

use Yii;
use admin\models\interfaces\ImageInterface;
//use admin\models\Image;

/**
 * This is the model class for table "business_directory".
 *
 * @property int $id
 * @property string $business_name
 * @property string|null $description
 * @property string|null $bannerimg
 * @property string|null $email
 * @property string|null $contactno
 * @property string|null $city
 * @property string|null $otherinfo
 * @property int|null $countryId
 * @property int|null $stateId
 *
 * 
 */
class BusinessDirectory extends \yii\db\ActiveRecord 
{
    /**
     * @var $TYPE
     */
    //public const TYPE = 'Business Directory';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'business_directory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['business_name'], 'required'],
            [['description', 'bannerimg','email','duration','otherinfo','contactno','textlink','weburl','keywords','ownercontact','storehours'], 'string'],
            [['countryId', 'stateId','contactno','duration'], 'integer'],
			[['city'],'safe'],
            [['business_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'business_name' => 'Business Name',
            'description' => 'Description',
            'banner_img' => 'Banner Image',
            'email' => 'Email',
            'contactno' => 'Contact Number',
            'countryId' => 'Country',
            'stateId' => 'State',
            'city' => 'City',
            'otherinfo' => 'Other Info',
        ];
    }
	/*
	*	Country list
	*	return countries Array
	*/
	public function getCountries()
	{
		$countries = ['0'=>'USA','1'=>'Columbia',
		'2'=>'UK'
		];
		return $countries;
	}
    /*
	*	State list
	*	return states Array
	*/
	public function getStates()
	{
		$states = ['0'=>'Alabama','1'=>'Arkansas',
		'2'=>'Florida',
		'3'=>'NJ'
		];
		return $states;
	}
}
