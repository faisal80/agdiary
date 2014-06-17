<?php
/* @var $this DefaultController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pensions',
);

$this->menu=array(
	array('label'=>'Create Pension', 'url'=>array('create')),
	array('label'=>'Manage Pension', 'url'=>array('admin')),
);
?>

<h1>Pensions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
