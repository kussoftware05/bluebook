<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\models\News */

$this->title = 'Update News: ';
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="news-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
