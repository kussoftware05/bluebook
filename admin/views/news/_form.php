<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;
use dosamigos\datepicker\DatePicker;
use admin\models\Category;
use admin\models\User;
use admin\models\State;
use admin\models\Country;
/* @var $this yii\web\View */
/* @var $model admin\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

	<?php //echo $form->field($model, 'content')->widget(CKEditor::className(), ['options' => ['rows' => 6], 'preset' => 'basic'])->label('Description') ?>

	<?= $form->field($model, 'content')
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
	<?php $countries = Country::find()->all();$countryData = ArrayHelper::map($countries,'id','name');?>
	<?php $states = State::find()->all();$stateData = ArrayHelper::map($states,'id','name');?>

    <?= $form->field($model, 'userId')->dropDownList($listData, ['prompt' => 'Select User'])->label('User') ?>
	
	<?php //echo $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'countryId')->dropDownList($countryData, ['prompt' => 'Select Country'])->label('Country') ?>
	<?= $form->field($model, 'stateId')->dropDownList($stateData, ['prompt' => 'Select State'])->label('State') ?>
	<?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

	<?php echo $form->field($model, 'published_at')->widget(
		DatePicker::className(), [
			// inline too, not bad
			 'inline' => true, 
			 // modify template for custom rendering
			'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
			'clientOptions' => [
				//'defaultDate' => date('Y-m-d'),
				'autoclose' => true,
				'todayHighlight' => true,
				'format' => 'yyyy-mm-dd'
			]
	]);?>
	
    <?php //echo $form->field($model, 'updated_at')->textInput() ?>

     <?= $form->field($model, 'status')->dropDownList([ 'Y' => 'Active', 'N' => 'In-Active', 'P'=> 'Pending' ]) ?>

	<?php /*echo $form->field($model, 'cat_id')->dropDownList(
				ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'name'),
                        [ 'prompt'=>'Select a Category' ] 
                    )->label('Category')*/ ?>
					
	<?= $form->field($model, 'newstype')->dropDownList([ 'article' => 'Article', 'news' => 'News', 'story'=> 'Story' ]) ?>
	
	<?= $form->field($model, 'mediatype')->dropDownList([ 'image' => 'Image', 'video' => 'Video', 'embVideo'=> 'Embeded Video' ]) ?>
	
	<?php if($model->news_image!=''){?>
     		    <img src="<?= Yii::$app->request->baseUrl.'/images/news/'.$model->news_image ?>" height="135" width="140" style="border-radius: 50%;" />
		    <?php } ?>
    <?= $form->field($model, 'news_image')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
