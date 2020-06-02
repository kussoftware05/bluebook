<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model admin\models\AdIntro */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Intro', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="news-view">

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
				'format' => 'raw',
				'value' => function($model){
					return 
					($model->filetype=='I')?
					'<img src="'. Yii::$app->request->baseUrl.'/images/intro/'.$model->filename.' " height="135" width="140" style="border-radius: 50%;" />'
					:
					'<iframe  width="200" height="200" src="'. Yii::$app->request->baseUrl.'/images/intro/'.$model->filename.' " frameborder="0" ></iframe>';
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
        ],
    ]) ?>

</div>
