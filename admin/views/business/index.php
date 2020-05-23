<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel admin\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Business Directory';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-index">
<<<<<<< HEAD
    

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
        <?= Html::a('Create Business Directory', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
=======
    <p>
        <?= Html::a('Create Business Directory', ['create'], ['class' => 'btn btn-success']) ?>
    </p>



>>>>>>> 1389c1b0c13cb80f2b7c6b5a8a2c836f1b4be705
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'business_name',
<<<<<<< HEAD
			[
				'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
				'label' => 'Description',
				'value' => function ($data) {
				   return strip_tags($data->description);
				},
			],
=======
            'description',
>>>>>>> 1389c1b0c13cb80f2b7c6b5a8a2c836f1b4be705
            'email',
            'contactno',
            [
                'class' => 'yii\grid\ActionColumn',
                
            ],

            
        ],
    ]); ?>


</div>
