<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\models\Notification */

$this->title = 'Send Notification: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Notification', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Send';
?>
<div class="news-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
