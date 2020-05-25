<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\models\BusinessDirectory */

$this->title = 'Update Business Directory: ' . $model->business_name;

$this->params['breadcrumbs'][] = ['label' => 'Business Directory', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->business_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="blog-update">

     <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
