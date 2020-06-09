<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use admin\models\Notification;
use admin\models\User;
/* @var $this yii\web\View */
/* @var $searchModel admin\models\NotificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notification';
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
	<?php $form = ActiveForm::begin(
		['action' => 'send']
		); ?>
    <p>
        
		<?= Html::submitButton('Send Notification', ['class' => 'btn btn-success']) ?>
		

    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
<<<<<<< HEAD
			'first_name',
=======
			'email',
>>>>>>> 1d71dced2658c879bdd0585bd7e5c63df943a945
			
			['class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => function($model){
			return ["value" => $model->id];
			}
			]
           //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php ActiveForm::end(); ?>

</div>
