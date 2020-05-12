<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model admin\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'short_desp')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'published_at')->textInput() ?>

    <?php //echo $form->field($model, 'updated_at')->textInput() ?>

     <?= $form->field($model, 'status')->dropDownList([ 'Y' => 'Active', 'N' => 'In-Active', 'P'=> 'Pending' ]) ?>

    <?= $form->field($model, 'cat_id')->textInput() ?>

    <?= $form->field($model, 'news_image')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
