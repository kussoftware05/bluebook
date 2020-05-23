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
    <p>
        <?= Html::a('Create Business Directory', ['create'], ['class' => 'btn btn-success']) ?>
    </p>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'business_name',
            'description',
            'email',
            'contactno',
            [
                'class' => 'yii\grid\ActionColumn',
                
            ],

            
        ],
    ]); ?>


</div>
