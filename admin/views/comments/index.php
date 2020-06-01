<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel admin\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-index">
    
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
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'comments',
			[
				'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
				'label' => 'Commented By',
				'value' => function ($data) {
				   return ($data->user->first_name);
				},
			],
			'commentedon:date',
			['class' => 'yii\grid\ActionColumn',
			'template' => "{update}",
			'buttons' => [
                'update' => function ($url, $model) {
                    return Html::a('<span class="btn btn-primary">Published</span>', $url, [
                                'title' => Yii::t('app', 'lead-view'),
                    ]);
                },
				]
			],
        
        ],
    ]); ?>


</div>
