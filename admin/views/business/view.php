<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model admin\models\Blog */

$this->title = $model->business_name;
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$img_src = Yii::$app->request->baseUrl.'/images/bannerImage/'.$model->bannerimg;
?>
<div class="blog-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
	if($model->bannerimg!=NULL)
	{
	?>
    <img src="<?= $img_src?>" width="250" height="200">
	<?php
	}
	?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
			'advertisername',
            'business_name',
			[
				'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
				'label' => 'Description',
				'value' => function ($data) {
				   return strip_tags($data->description);
				},
			],
            'email',
            'contactno',
        ],
    ]) ?>

</div>
