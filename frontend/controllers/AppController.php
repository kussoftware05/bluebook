<?php
namespace frontend\controllers;
use Yii;
use yii\rest\ActiveController;
use yii\helpers\Url;
use yii\helpers\Html;
use common\components\API;
use common\models\User;
use admin\models\News;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\db\ActiveQuery;
use yii\db\Query;
use yii\filters\AccessControl;
use admin\models\AdIntro;
use admin\models\BusinessDirectory;


/**
 * PostController implements the CRUD actions for Post model.
 */
class AppController extends ActiveController
{
   	public $modelClass = 'frontend\models\LoginForm';
	/*
	* api for login
	* request parameters
	* url like "https://kusdemos.com/bluebook/app/login"
	* {"data":{"username":"admin","password":"admin"}}
	*/
	public function actionLogin()
    {
		$data = array();
		
		if (!API::getInputDataArray($data, array('username','password', 'user_lat', 'user_long')))
		{
            return API::echoJsonError('ERROR: Please provide username and password'.$data);
		}
		
		$user = User::findByUsername($data['username']);
		if(!$user || (!$user->validatePassword($data['password'])))
		{
			return API::echoJsonError('ERROR: Username and / or password were Incorrect');
		}
		
		$user->user_lat = $data['user_lat'];
		$user->user_long = $data['user_long'];
		$user->save();	
		
		$userdetails = User::find()->where(['id' =>$user['id']])->All();
		$returnArray['error'] = 0;
		$returnArray['data'] = array('user'=>$userdetails);
		return $returnArray;
	}
	/*
	* api for signup
	* request parameters
	* {"data":{"name":"admin2","email":"adminil@gmail.com","password":"adm#123"}}
	*/
	public function actionSignup()
	{
		if (!API::getInputDataArray($data, array('name', 'email', 'phone', 'password', 'user_lat', 'user_long')))
            return;
		$emailCheck = User::find()->where(['email' =>$data['email']])->one();
			
		if (isset($emailCheck))
            return API::echoJsonError ('ERROR: email address was already in the User table', 'The given email address already has an account associated with it.');
		$user = new User();
		$user->first_name = $data['name'];
		$user->username = $data['email'];
		$user->email = $data['email'];
		$user->phone = $data['phone'];
		$user->usertype = 'F';
		$user->gender = 'M';
		$user->status = 'Y';
		$user->user_lat = $data['user_lat'];
		$user->user_long = $data['user_long'];
		$user->setPassword($data['password']);
        $user->generateAuthKey();
		$user->save();	
		$returnArray['error'] = 0;
		$returnArray['data'] = array('user'=>$user);
		return $returnArray;
	}
	/*
	* api for news list/details
	* request parameters
	* data:{"data":{"id":"2"}}
	*/
	public function actionNews()
	{
		$news = News::find()->where(['status' =>'Y'])->all();
		
		if (!isset($news))
            return API::echoJsonError ('ERROR: no news in news table', 'No any news items found.');
		
		$returnArray['error'] = 0;
		$returnArray['data'] = array('news'=>$news);
		return $returnArray;
	}
	
	
	// news details
	public function actionNewsdetails()
	{
		if (!API::getInputDataArray($data, array('id')))
            return;
		$newsdetails= News::find()->where(['id' =>$data['id']])->one();
		$returnArray['error'] = 0;
		$returnArray['data'] = array('newsdetails'=>$newsdetails);
		return $returnArray;
	}

	/*
	* api for news list posted from mobile app
	* 
	*/
	public function actionNewsPosted()
	{
		$news = News::find()->where(['newspostedfrom' => 'M'])->all();
			
		if (!isset($news))
            return API::echoJsonError ('ERROR: no news in news table', 'No any news items found.');
		
		$returnArray['error'] = 0;
		$returnArray['data'] = array('news'=>$news);
		return $returnArray;
	}
	/*
	* api for AdIntro list
	* 
	*/
	public function actionIntro()
	{
		$aditems = AdIntro::find()->all();
			
		if (!isset($aditems))
            return API::echoJsonError ('ERROR: no items in ad_intro table', 'No any intro items found.');
		
		$returnArray['error'] = 0;
		$returnArray['data'] = array('aditems'=>$aditems);
		return $returnArray;
	}
	/*
	* api for Business Directory list
	* 
	*/
	public function actionAdvertisements()
	{
		$business = BusinessDirectory::find()->all();
			
		if (!isset($business))
            return API::echoJsonError ('ERROR: no items in business_directory table', 'No any business items found.');
		
		$returnArray['error'] = 0;
		$returnArray['data'] = array('data'=>$business);
		return $returnArray;
	}
}