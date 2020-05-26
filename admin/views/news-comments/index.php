<?php

use yii\helpers\Html;
use yii\grid\GridView;
use admin\models\User;
/* @var $this yii\web\View */
/* @var $searchModel admin\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
$user= User::find()->all();
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
        <?= Html::a('Create News Comments', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			[
			  'attribute' => 'comments',
			  'format' => 'html',
			   'headerOptions' => ['style' => 'width:25%'],
			],
			[
			  'attribute' => 'postedon',
			  'format' => 'date',
			   'headerOptions' => ['style' => 'width:10%'],
			],
			[
				'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
				'label' => 'User',
				'value' => function ($data) {
				   return $data->user ? $data->user->first_name : '';
				},
			],
            [
				'attribute' => 'Status',
				'format' => 'raw',
				'value' =>  function ($model) {
                    return ($model ->status == 'Y') ? '<span class="label label-success">Published</span>' : '<span class="label label-danger">Not-Published</span>';
                },
				'filter'=> ['Y'=>'Active','N'=>'Non-Active', 'P' => 'Pending'],
			],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
