<?php
namespace frontend\controllers;
use Yii;
use yii\rest\ActiveController;
use yii\helpers\Url;
use yii\helpers\Html;
use common\components\API;
use common\models\User;

use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use frontend\models\FollowerDetails;
use frontend\models\RequestDelete;
use frontend\models\NominateLeader;
use frontend\models\Categories;
use frontend\models\Country;
use frontend\models\NominateLeaderDetails;
use frontend\models\Pages;
use admin\models\Post;
use admin\models\LeaderInvite;
use yii\db\ActiveQuery;
use yii\db\Query;
use yii\data\SqlDataProvider;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;



/**
 * PostController implements the CRUD actions for Post model.
 */
class AppController extends ActiveController
{
   	public $modelClass = 'frontend\models\LoginForm';
	public function actionLogin()
    {
		$data = array();
		
		if (!API::getInputDataArray($data, array('username','password')))
		{
            return API::echoJsonError('ERROR: Please provide username and password'.$data);
		}
		
		$user = User::findByUsername($data['username']);
		if(!$user || (!$user->validatePassword($data['password'])))
		{
			return API::echoJsonError('ERROR: Username and / or password were Incorrect');
		}
		$userdetails = User::find()->where(['id' =>$user['id']])->All();
		$returnArray['error'] = 0;
		$returnArray['data'] = array('user'=>$userdetails);
		return $returnArray;
	}
	public function actionSignup()
	{
		if (!API::getInputDataArray($data, array('name', 'email', 'password')))
            return;
		$emailCheck = User::find()->where(['email' =>$data['email']])->one();
			
		if (isset($emailCheck))
            return API::echoJsonError ('ERROR: email address was already in the User table', 'The given email address already has an account associated with it.');
		$user = new User();
		$user->first_name = $data['name'];
		$user->username = $data['email'];
		$user->email = $data['email'];
		$user->usertype = 'F';
		$user->gender = 'M';
		$user->setPassword($data['password']);
        $user->generateAuthKey();
		$user->save();	
		$returnArray['error'] = 0;
		$returnArray['data'] = array('user'=>$user);
		return $returnArray;
	}
}
	