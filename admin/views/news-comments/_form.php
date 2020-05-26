<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
use dosamigos\datepicker\DatePicker;
use admin\models\NewsComments;
use admin\models\User;
use admin\models\News;
/* @var $this yii\web\View */
/* @var $model admin\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

	<?php //echo $form->field($model, 'comments')->widget(CKEditor::className(), ['options' => ['rows' => 6], 'preset' => 'basic'])->label('Description') ?>

	<?= $form->field($model, 'comments')
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

    <?php $user = User::find()->all();$listData = ArrayHelper::map($user,'id','first_name');?>
	<?php $news = News::find()->all();$newsData = ArrayHelper::map($news,'id','title');?>

    <?= $form->field($model, 'userId')->dropDownList($listData, ['prompt' => 'Select User'])->label('User') ?>
	
	<?= $form->field($model, 'newsId')->dropDownList($newsData, ['prompt' => 'Select User'])->label('News') ?>

     <?= $form->field($model, 'status')->dropDownList([ 'Y' => 'Published', 'N' => 'Not-Published']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
