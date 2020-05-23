<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
<<<<<<< HEAD
use dosamigos\ckeditor\CKEditor;
=======
<<<<<<< HEAD
use dosamigos\ckeditor\CKEditor;
=======
>>>>>>> 1389c1b0c13cb80f2b7c6b5a8a2c836f1b4be705
>>>>>>> 9def3276bbad56c09a0c2dd1a592591d3060a4e1
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
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 9def3276bbad56c09a0c2dd1a592591d3060a4e1
                
				<?= $form->field($model, 'description')->widget(CKEditor::className(), ['options' => ['rows' => 6], 'preset' => 'basic']) ?>
				<?=Html::label('Banner Image')?>
				<?php if($model->bannerimg!=''){?>
				<div><img src="<?= Yii::$app->request->baseUrl.'/images/bannerImage/'.$model->bannerimg ?>" height="150" width="200"/></div>
				<?php } ?>
<<<<<<< HEAD
=======
=======
                <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
				<?=Html::label('Banner Image')?>
>>>>>>> 1389c1b0c13cb80f2b7c6b5a8a2c836f1b4be705
>>>>>>> 9def3276bbad56c09a0c2dd1a592591d3060a4e1
				<?= $form->field($model, 'bannerimg')->fileInput(['accept' => 'image/*'])->label(false); ?>
				<?= $form->field($model, 'duration')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
				<?= $form->field($model, 'contactno')->textInput(['maxlength' => true])->label('Contact') ?>
<<<<<<< HEAD
				<?= $form->field($model, 'userId')->dropDownList($listData, ['prompt' => 'Select User'])->label('User') ?>
=======
				<?= $form->field($model, 'userId')->dropDownList($listData, ['prompt' => 'Select User']) ?>
>>>>>>> 9def3276bbad56c09a0c2dd1a592591d3060a4e1
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

