<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model admin\models\settings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-form">

    <?php $form = ActiveForm::begin(); ?>
	<?= $form->field($model, 'facebook_add')->textarea(['rows' => '6']) ?>
	<?= $form->field($model, 'google_add')->textarea(['rows' => '6']) ?>
	<?php /*?><?= $form->field($model, 'twitter')->textInput() ?>
	
	<?= $form->field($model, 'copyright')->textInput() ?><?php */?>
	<?= $form->field($model, 'admin_email')->textInput() ?>
	<?php /*?><?= $form->field($model, 'contact_email')->textInput() ?>
	<?= $form->field($model, 'contact_phone')->textInput() ?>
	<?= $form->field($model, 'contact_address')->textInput() ?><?php */?>
  <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
