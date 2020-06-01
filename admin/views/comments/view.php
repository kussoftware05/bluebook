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
<style>
.comments-border{
	border:1px #fff solid;
}
</style>
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
	<div  class="grid-view">
	<table class="table table-striped table-bordered">
	<thead>
	<tr><th>#</th>
	<th>Comments</th>
	<th>Commented By</th>
	<th>Date of Comment</th>
	<th></th>
	</tr>
	</thead>
	<tbody>
	<?php
	foreach($model as $m)
	{
	?>
	<tr><td></td>
	<td><?=$m->comments;?></td>
	<td><?=$m->user->first_name?></td>
	<td><?=date('d-m-Y',strtotime($m->commentedon))?></td>
	<td>
	
	<?php if($m->published)
		{	
		?>
		<?= Html::tag('p', Html::encode('Not Published'), ['class' => 'btn btn-primary']) ?>
		<?php
		}
		else
		{
		?>
		<?= Html::tag('p', Html::encode('Published'), ['class' => 'btn btn-primary']) ?>
		<?php	
		}
		?>
	</td>
	
	</tr>
	<?php
	}
	?>
	</tbody>
	</table>
	</div>
	

</div>
