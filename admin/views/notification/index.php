<?php

use yii\helpers\Html;
use yii\grid\GridView;
use admin\models\Notification;
use admin\models\User;
/* @var $this yii\web\View */
/* @var $searchModel admin\models\NotificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notification';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="news-index">

	<?php if (Yii::$app->session->hasFlash('success')): ?>
		<div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <?= Yii::$app->session->getFlash('success') ?>
   </div>
	<?php endif; ?>

	<?php if ( Yii::$app->session->hasFlash('error') ): ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <?= Yii::$app->session->getFlash('error') ?>
    </div>
	<?php endif ?>
	
    <p>
        <?= Html::a('Send Notification', ['send'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			'email',
			
			['class' => 'yii\grid\CheckboxColumn']
           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
