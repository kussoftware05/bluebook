<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model admin\models\Category */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFile("/bluebook/admin/css/admin.css");
?>

<div class="category-form">

    <div class="row">

        <div class="pesonal_details col-sm-6 .col-md-6 sereg box box-danger">

        <?php $form = ActiveForm::begin(); ?>
                <h3>User Details</h3> 
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'status')->dropDownList([ 'Y' => 'Active', 'N' => 'In-Active', ]) ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
