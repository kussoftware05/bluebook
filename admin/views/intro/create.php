<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\models\News */

$this->title = 'Create Intro';
$this->params['breadcrumbs'][] = ['label' => 'Intro', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
