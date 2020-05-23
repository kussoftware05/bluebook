<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
<<<<<<< HEAD
/* @var $model admin\models\BusinessDirectory */

$this->title = 'Update Business Directory: ' . $model->business_name;
=======
/* @var $model admin\models\Blog */

$this->title = 'Update Blog: ' . $model->business_name;
>>>>>>> 1389c1b0c13cb80f2b7c6b5a8a2c836f1b4be705
$this->params['breadcrumbs'][] = ['label' => 'Business Directory', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->business_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="blog-update">

     <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
