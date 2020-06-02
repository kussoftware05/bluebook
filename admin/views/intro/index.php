<?php

use yii\helpers\Html;
use yii\grid\GridView;
use admin\models\AdIntro;
/* @var $this yii\web\View */
/* @var $searchModel admin\models\AdIntroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ad Intro';
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
        <?= Html::a('Create Intro', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			'title',
			[
				'attribute' => 'description',
				'format' => 'html',
				'value' => function($model){
					return strip_tags($model->description);
				}
			],
			[
				'attribute' => 'filename',
				'label' => 'Intro Image/Video',
				'format' => 'html',
				'value' => function($model){
					return 
					($model->filetype=='I')?
					'<img src="'. Yii::$app->request->baseUrl.'/images/intro/'.$model->filename.' " height="135" width="140" style="border-radius: 50%;" />':
					'';
				}
			],
			[
				'attribute' => 'filetype',
				'format' => 'raw',
				'value' =>  function ($model) {
					return ($model->filetype=='I') ?'Image':'Video';
				}
			],
			'displayorder',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
