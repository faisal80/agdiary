<?php
/* @var $this DefaultController */
/* @var $model Pension */

$this->breadcrumbs=array(
	'Pensions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pension', 'url'=>array('index')),
	array('label'=>'Manage Pension', 'url'=>array('admin')),
);
?>

<h1>Create Pension</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>