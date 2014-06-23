<?php
/* @var $this DefaultController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pension Cases',
);

$this->menu=array(
	array('label'=>'Enter New Pension Case', 'url'=>array('create')),
	array('label'=>'Manage Pension Cases', 'url'=>array('admin')),
);
?>

<h1>Pension Cases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
