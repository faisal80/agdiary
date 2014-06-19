<?php
/* @var $this DisposalController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pension Disposals',
);

$this->menu=array(
	array('label'=>'Create PensionDisposal', 'url'=>array('create')),
	array('label'=>'Manage PensionDisposal', 'url'=>array('admin')),
);
?>

<h1>Pension Disposals</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
