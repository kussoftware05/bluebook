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

    <?= $form->field($model, 'comments')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'published')->dropDownList([ '1' => 'Yes', '0' => 'No']) ?>
    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
