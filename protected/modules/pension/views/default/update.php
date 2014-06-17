<?php
/* @var $this DefaultController */
/* @var $model Pension */

$this->breadcrumbs=array(
	'Pensions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pension', 'url'=>array('index')),
	array('label'=>'Create Pension', 'url'=>array('create')),
	array('label'=>'View Pension', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Pension', 'url'=>array('admin')),
);
?>

<h1>Update Pension <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>