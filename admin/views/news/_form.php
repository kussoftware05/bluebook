<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use admin\models\Category;
use dosamigos\ckeditor\CKEditor;
//use kartik\date\DatePicker;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model admin\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'content')->widget(CKEditor::className(), ['options' => ['rows' => 6], 'preset' => 'basic'])->label('Description') ?>

    

    <?php //echo $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'published_at')->widget(
    DatePicker::className(), [
        // inline too, not bad
         'inline' => true, 
         // modify template for custom rendering
        'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
]);?>

    <?php //echo $form->field($model, 'updated_at')->textInput() ?>

     <?= $form->field($model, 'status')->dropDownList([ 'Y' => 'Active', 'N' => 'In-Active', 'P'=> 'Pending' ]) ?>

	<?php /*echo $form->field($model, 'cat_id')->dropDownList(
				ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'name'),
                        [ 'prompt'=>'Select a Category' ] 
                    )->label('Category')*/ ?>
					
	<?= $form->field($model, 'newstype')->dropDownList([ 'airtle' => 'Airtle', 'news' => 'News', 'story'=> 'Story' ]) ?>
	
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
