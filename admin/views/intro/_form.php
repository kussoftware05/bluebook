<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model admin\models\AdIntro */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'description')
         ->widget(CKEditor::className(), 
            [
              'options' => [], 
              'preset' => 'advanced',
              'clientOptions' => [
                  'extraPlugins' => '',
                  'height' => 500,

                  //Here you give the action who will handle the image upload 
                  'filebrowserUploadUrl' => '/site/ckeditor_image_upload',

                  'toolbarGroups' => [
                      ['name' => 'undo'],
                      ['name' => 'basicstyles', 'groups' => ['basicstyles', 'cleanup']],
                      ['name' => 'paragraph', 'groups' => ['list', 'indent', 'blocks', 'align', 'bidi' ]],
                      ['name' => 'styles'],
                      ['name' => 'links', 'groups' => ['links', 'insert']]
                  ]

              ]

            ]) 

?>
	<?= $form->field($model, 'filetype')->dropDownList([ 'I' => 'Image', 'V' => 'Video']) ?>
	<?= $form->field($model, 'filename')->fileInput()->label('Upload Image/Video') ?>
	<?php if($model->filename!='' && $model->filetype=='I'){?>
     		    <img src="<?= Yii::$app->request->baseUrl.'/images/intro/'.$model->filename ?>" height="135" width="140" style="border-radius: 50%;" />
		    <?php } ?>
    <?php if($model->filename!='' && $model->filetype=='V'){?>
				<video width="320" height="240" controls>
				  <source src="<?= Yii::$app->request->baseUrl.'/images/intro/'.$model->filename ?>" type="video/mp4">
				Your browser does not support the video tag.
				</video>
     		    
		    <?php } ?>
	<?= $form->field($model, 'displayorder')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
