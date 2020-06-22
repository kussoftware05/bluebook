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
use admin\models\State;
use admin\models\Country;
use admin\models\NewsComments;

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
	
	/*
	* api for add news details
	* request parameters
	* data:{"data":{"title":"News1", "userId":"1"}}
	* https://kusdemos.com/bluebook/app/post-content
	*/
	public function actionPostContent()
	{
		if (!API::getInputDataArray($data, array('title','userId')))
            return;
		$newsCheck = News::find()->where(['title' =>$data['title']])->one();
			
		if (isset($newsCheck))
            return API::echoJsonError ('ERROR: Title was already in the News table', 'The given title has to be unique.');
		
		$news = new News();
		$news->title = $data['title'];
		$news->userId = $data['userId'];
		
		if(isset($_FILES['news_image']))
		{
			$news_image = $_FILES['news_image']['name'];
			
			$incoming_report_path = Yii::getAlias('@webroot/admin/images/news/'.$news_image);
            if (!move_uploaded_file($_FILES['news_image']['tmp_name'], $incoming_report_path))
            {
                return API::echoJsonError($errorMsg, 'There was an error recieving the assessmentzip POST param file. DEBUG: '.var_export($_FILES['news_image'], true));
            }
			$news->news_image = $news_image;
        }
		if(isset($_FILES['news_video']))
		{
			$news_video = $_FILES['news_video']['name'];
			
			$incoming_report_path = Yii::getAlias('@webroot/admin/videos/news/'.$news_video);
            if (!move_uploaded_file($_FILES['news_video']['tmp_name'], $incoming_report_path))
            {
                return API::echoJsonError($errorMsg, 'There was an error recieving the assessmentzip POST param file. DEBUG: '.var_export($_FILES['news_video'], true));
            }
			$news->news_image = $news_video;
        }
		if(isset($data['content']))
			$news->content = $data['content'];
				
		$news->save();	
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
	/*
	* api for post ad
	* request parameters
	* data:{"data":{"business_name":"bus1"}}
	*/
	public function actionPostAd()
	{
		if (!API::getInputDataArray($data, array('business_name','address1')))
            return;
		$isBusinessName = BusinessDirectory::find()->where(['business_name' =>$data['business_name']])->one();
			
		if (isset($isAdtvertiseName))
            return API::echoJsonError ('ERROR: advertise name already exist in the business_directory table', 'The given advertise already exist.');
		$business = new BusinessDirectory();
		$business->business_name = $data['business_name'];
		
		if(isset($data['email']))
		{
			$business->email = $data['email'];
		}
		if(isset($data['weburl']))
		{
			$business->weburl = $data['weburl'];
		}
		if(isset($data['contactno']))
		{
			$business->contactno = $data['contactno'];
		}
		if(isset($data['otherinfo']))
		{
			$business->otherinfo = $data['otherinfo'];
		}
		
		$bannerImg = "";
		if(isset($_FILES['bannerimg']))
		{
			$bannerImg = $_FILES['bannerimg']['name'];
			
			$imagePath = Yii::getAlias('@webroot/admin/images/bannerImage/'.$bannerImg);
            if (!move_uploaded_file($_FILES['bannerimg']['tmp_name'], $imagePath))
            {
                return API::echoJsonError($errorMsg, 'There was an error recieving the assessmentzip POST param file. DEBUG: '.var_export($_FILES['bannerimg'], true));
            }
			$business->bannerimg = $bannerImg;
        }
		$smallBannerImage = "";
		
		if(isset($_FILES['small_banner_image']))
		{
			$smallBannerImage = $_FILES['small_banner_image']['name'];
			
			$imagePath = Yii::getAlias('@webroot/admin/images/smallBannerImage/'.$smallBannerImage);
            if (!move_uploaded_file($_FILES['small_banner_image']['tmp_name'], $imagePath))
            {
                return API::echoJsonError($errorMsg, 'There was an error recieving the assessmentzip POST param file. DEBUG: '.var_export($_FILES['small_banner_image'], true));
            }
			$business->small_banner_image = $smallBannerImage;
        }
		if(isset($data['address1']))
		{
			$business->address1 = $data['address1'];
		}
		if(isset($data['city']))
		{
			
			$business->city = $data['city'];
		}
		if(isset($data['country']))
		{
			$countryRec = Country::find()->where(['name' =>$data['country']])->one();
			if (!isset($countryRec))
				return API::echoJsonError ('ERROR: country name not exist in the country table', 'The given country does not exist.');
			$business->countryId = $countryRec->id;
		}
		if(isset($data['state']))
		{
			$stateRec = State::find()->where(['name' =>$data['state']])->one();
			if (!isset($stateRec))
				return API::echoJsonError ('ERROR: state name not exist in the state table', 'The given state does not exist.');
			$business->stateId = $stateRec->id;
		}
		if(isset($data['zip']))
		{
			$business->zip = $data['zip'];
		}
		if(isset($data['description']))
		{
			$business->description = $data['description'];
		}
		$business->save();	
		$returnArray['error'] = 0;
		$returnArray['data'] = array('business'=>$business);
		return $returnArray;
	}
	/*
	* api for post ad
	* request parameters
	* {"data":{"newsId":"4", "userId":"4", "comments":"test api"}}
	*/
	public function actionPostComments()
	{
		if (!API::getInputDataArray($data, array('newsId', 'userId', 'comments')))
            return;
		
		$userCheck = User::find()->where(['id' =>$data['userId']])->one();		
		if (!isset($userCheck))
            return API::echoJsonError ('ERROR: User does not exist', 'User does not exist');
		
		$newsCheck = News::find()->where(['id' =>$data['newsId']])->one();	
		if (!isset($newsCheck))
            return API::echoJsonError ('ERROR: News does not exist', 'News does not exist');
		
		$news_comments = new NewsComments();
		$news_comments->newsId = $data['newsId'];
		$news_comments->userId = $data['userId'];
        $news_comments->comments = $data['comments'];
		$news_comments->commentedon = date('Y-m-d H:i:s');
		$news_comments->published = "1";
		$news_comments->save();	
		$returnArray['error'] = 0;
		$returnArray['data'] = array('data'=>$news_comments);
		return $returnArray;
	}
	/*
	* api for comments list
	* request parameters
	* data:{"data":{"newsId":"1"}}
	*/
	public function actionCommentsList()
	{
		if (!API::getInputDataArray($data, array('newsId')))
            return;
		
		$newsCheck = News::find()->where(['id' =>$data['newsId']])->one();	
		if (isset($userCheck))
            return API::echoJsonError ('ERROR: News does not exist', 'News does not exist');
		
		$comments = NewsComments::find()->where(
		[
			'newsId' => $data['newsId'],
			'published' => 1,
		])->orderBy(['commentedon'=>SORT_ASC])->all();
			
		if (!isset($comments))
            return API::echoJsonError ('ERROR: no items in comments table', 'No any comments items found.');
		
		$returnArray['error'] = 0;
		$returnArray['data'] = array('data'=>$comments);
		return $returnArray;
	}
}