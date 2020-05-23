<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
<<<<<<< HEAD
/* @var $model admin\models\BusinessDirectory */

$this->title = 'Update Business Directory: ' . $model->business_name;
=======

/* @var $model admin\models\BusinessDirectory */

$this->title = 'Update Business Directory: ' . $model->business_name;

>>>>>>> 9def3276bbad56c09a0c2dd1a592591d3060a4e1
$this->params['breadcrumbs'][] = ['label' => 'Business Directory', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->business_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="blog-update">

     <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
