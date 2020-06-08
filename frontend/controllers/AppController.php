<?php
namespace frontend\controllers;
use Yii;
use yii\rest\ActiveController;
use yii\helpers\Url;
use yii\helpers\Html;
use common\components\API;
use common\models\User;



/**
 * PostController implements the CRUD actions for Post model.
 */
class AppController extends ActiveController
{
   	public $modelClass = 'frontend\models\LoginForm';
	public function actionLogin()
    {
		$data = array();
		API::getInputDataArray($data, array('username', 'password'));
		//if (!API::getInputDataArray($data, array('username', 'password')))
           // return;
		//$user = User::findByUsername($data['username']);
		/*if(!$user || (!$user->validatePassword($data['password'])))
		{
			return API::echoJsonError('ERROR: Username and / or password were Incorrect');
		}*/
		$returnArray['error'] = 0;
		return $returnArray;
	}
	public function actionSignup()
	{
		if (!API::getInputDataArray($data, array('name', 'email', 'country', 'password')))
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
		return $returnArray;
	}
	
}
	