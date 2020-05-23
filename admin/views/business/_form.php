<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use admin\models\User;
/* @var $this yii\web\View */
/* @var $model admin\models\Blog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-9">

                <?= $form->field($model, 'business_name')->textInput(['maxlength' => true]) ?>
                
                <?php $user = User::find()->all();$listData = ArrayHelper::map($user,'id','first_name');?>
                <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
				<?=Html::label('Banner Image')?>
				<?= $form->field($model, 'bannerimg')->fileInput(['accept' => 'image/*'])->label(false); ?>
				<?= $form->field($model, 'duration')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'contactno')->textInput(['maxlength' => true])->label('Contact') ?>
				<?= $form->field($model, 'userId')->dropDownList($listData, ['prompt' => 'Select User']) ?>
				<?=Html::label('Location')?>
				<?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
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

