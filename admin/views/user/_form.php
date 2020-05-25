<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use admin\models\State;
use admin\models\Country;

/* @var $this yii\web\View */
/* @var $model admin\models\User */
/* @var $form yii\widgets\ActiveForm */


$this->registerCssFile("/bluebook/admin/css/admin.css");

?>

<div class="user-form usr_stle">
  
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="pesonal_details col-sm-6 col-md-6 sereg box box-danger">
            <h3>Pesonal Details</h3>
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
        <?php if($model -> isNewRecord ){ ?>
        <div class="login_inf col-sm-6 col-md-6 sereg box box-primary">
            <h3> Login Information </h3>
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>
        </div>
        <?php } ?>
    </div>


    <div class="row">
        <div class="pesonal_details col-md-6 box box-info sereg">
            <h3>Identifiaction</h3>
            <?php if($model->user_pic!=''){?>
     		    <img src="<?= Yii::$app->request->baseUrl.'/images/user/'.$model->user_pic ?>" height="135" width="140" style="border-radius: 50%;" />
		    <?php } ?>
            <?= $form->field($model, 'user_pic')->fileInput(['multiple' => true, 'accept' => 'image/*']) ->label('Profile Picture');?>

            <?= $form->field($model, 'usertype')->dropDownList(['A' => 'Admin','G' => 'General']) ?>

            <?= $form->field($model, 'gender')->dropDownList([ 'M' => 'Male', 'F' => 'Female']) ?>
            <?= $form->field($model, 'bio')->widget(CKEditor::className(), ['options' => ['rows' => 6], 'preset' => 'basic']) ?>
			<?= $form->field($model, 'status')->dropDownList([ 'Y' => 'Active', 'N' => 'In-Active', ]) ?>
        </div>

        <div class="login_inf col-md-6 box box-success sereg">
            <h3>Contact Details</h3>
			<?php $countries = Country::find()->all();$countryData = ArrayHelper::map($countries,'id','name');?>
			<?php $states = State::find()->all();$stateData = ArrayHelper::map($states,'id','name');?>
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'countryId')->dropDownList($countryData, ['prompt' => 'Select Country'])->label('Country') ?>
			<?= $form->field($model, 'stateId')->dropDownList($stateData, ['prompt' => 'Select State'])->label('State') ?>
			<?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
