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

<<<<<<< HEAD:admin/views/business/view.php
    
    <img src="<?= $img_src  ?>" width="250" height="200">
=======
<<<<<<< HEAD:admin/views/business/view.php
    
    <img src="<?= $img_src  ?>" width="250" height="200">
=======
    <h1><?= Html::encode($this->title) ?></h1>
    <img src="<? //= $img_src ?>" width="250" height="200">
>>>>>>> 1389c1b0c13cb80f2b7c6b5a8a2c836f1b4be705:admin/views/blog/view.php
>>>>>>> 9def3276bbad56c09a0c2dd1a592591d3060a4e1:admin/views/blog/view.php

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'business_name',
            'description',
            'email',
            'contactno',
        ],
    ]) ?>

</div>
