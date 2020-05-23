<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\models\Blog */

$this->title = 'Create Business Directory';
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-create">

    

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
