<?php

use yii\helpers\Html;
use yii\grid\GridView;
use admin\models\User;
use yii\widgets\ListView;
/* @var $this yii\web\View */
/* @var $searchModel admin\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News Comments';
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
	<?php
	foreach($model as $m)
	{
	?>
	<div style="background-color: skyblue; padding: 5px 15px;margin-bottom:5px;width:600px;height:240px;">
    <?=$m->comments;?> 
	<div style="float:right;margin-top:30px;">By <?=$m->user->first_name?></div>
	<div style="float:right;margin-top:30px;clear:both;"> <?=date('d-m-Y',strtotime($m->commentedon))?></div> 
	<div style="margin-top:160px;">
		<?php if($m->published)
		{	
		?>
		<?= Html::tag('p', Html::encode('Not Published'), ['class' => 'btn btn-success']) ?>
		<?php
		}
		else
		{
		?>
		<?= Html::tag('p', Html::encode('Published'), ['class' => 'btn btn-success']) ?>
		<?php	
		}
		?>
    </div>
	
	</div>
	<?php
	}
	?>
	</div>

</div>
