<?php
$this->breadcrumbs=array(
	'Disposals'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Disposal', 'url'=>array('index')),
	array('label'=>'Create Disposal', 'url'=>array('create')),
	array('label'=>'Update Disposal', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Disposal', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Disposal', 'url'=>array('admin')),
);
?>

<h1>View Disposal #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'document_id',
		'officer_id',
		'disposal_date',
		'disposal',
	),
)); ?>
