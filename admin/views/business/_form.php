<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
use admin\models\State;
use admin\models\Country;
use admin\models\User;
use admin\models\BusinessDirectory;
/* @var $this yii\web\View */
/* @var $model admin\models\Blog */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(Yii::$app->request->baseUrl.'/js/business.js',['depends' => [\yii\web\JqueryAsset::className()]]); 
?>

<div class="blog-form">

    <?php $form = ActiveForm::begin(['options' => [
	'enctype' => 'multipart/form-data',	
	'validateOnChange'=>true,
	'id' => 'form-business',
    'enableAjaxValidation' => true,
                    'enableClientValidation' => true,
	]]); ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-9">

                <?= $form->field($model, 'business_name')->textInput(['maxlength' => true]) ?>
                <?php $user = User::find()->all();$listData = ArrayHelper::map($user,'id','first_name');?>
                <?php $countries = Country::find()->all();$countryData = ArrayHelper::map($countries,'id','name');?>
				<?php $states = State::find()->all();$stateData = ArrayHelper::map($states,'id','name');?>
				<?= $form->field($model, 'description')->widget(CKEditor::className(), ['options' => ['rows' => 6], 'preset' => 'advanced']) ?>
				
				<?php if($model->bannerimg!=''){?>
				<div><img src="<?= Yii::$app->request->baseUrl.'/images/bannerImage/'.$model->bannerimg ?>" height="150" width="200"/></div>
				<?php } ?>
				<?= $form->field($model, 'bannerimg')->fileInput(['accept' => 'image/*']) ?>
				
				<?php if($model->small_banner_image!=''){?>
				<div><img src="<?= Yii::$app->request->baseUrl.'/images/smallBannerImage/'.$model->small_banner_image ?>" height="150" width="200"/></div>
				<?php } ?>
				<?= $form->field($model, 'small_banner_image')->fileInput(['accept' => 'image/*'])?>
				<?= $form->field($model, 'duration')->textInput(['maxlength' => true]) ?>				
				<?= $form->field($model, 'userId')->dropDownList($listData, ['prompt' => 'Select User'])->label('User') ?>
				<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'contactno')->textInput(['maxlength' => true])->label('Contact') ?>
				
				<?=Html::label('Location')?>
				<?= $form->field($model, 'address1')->textInput(['maxlength' => true, 'readOnly'=> true]) ?>
				<?= $form->field($model, 'countryId')->dropDownList($countryData, ['prompt' => 'Select Country','readOnly'=> true])->label('Country') ?>
				<?= $form->field($model, 'stateId')->dropDownList($stateData, ['prompt' => 'Select State', 'readOnly'=> true])->label('State') ?>
				<?= $form->field($model, 'city')->textInput(['maxlength' => true, 'readOnly'=> true]) ?>
				<?= $form->field($model, 'otherinfo')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'textlink')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'weburl')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'ownercontact')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'storehours')->textInput(['maxlength' => true]) ?>
				
            </div>
            <div class="col-sm-3 col-md-3">
            
                

               

            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

