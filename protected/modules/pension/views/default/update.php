<?php
/* @var $this DefaultController */
/* @var $model Pension */

$this->breadcrumbs=array(
	'Pension Cases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pension Cases', 'url'=>array('index')),
	array('label'=>'Enter New Pension Case', 'url'=>array('create')),
	array('label'=>'View Pension Case', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Pension Cases', 'url'=>array('admin')),
);
?>

<h1>Update Pension <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>