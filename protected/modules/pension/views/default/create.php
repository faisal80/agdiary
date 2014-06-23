<?php
/* @var $this DefaultController */
/* @var $model Pension */

$this->breadcrumbs=array(
	'Pension Cases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pension Cases', 'url'=>array('index')),
	array('label'=>'Manage Pension Cases', 'url'=>array('admin')),
);
?>

<h1>Enter New Pension Case</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>