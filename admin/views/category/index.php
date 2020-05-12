<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel admin\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            [
				'attribute' => 'Status',
				'format' => 'raw',
				'value' =>  function ($model) {
                    return ($model ->status == 'Y') ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">In-Active</span>';
                },
				'filter'=> ['Y'=>'Active','N'=>'Non-Active'],
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
