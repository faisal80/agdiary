<?php
$this->breadcrumbs=array(
	'Markeds'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Marked', 'url'=>array('index')),
	array('label'=>'Create Marked', 'url'=>array('create')),
	array('label'=>'Update Marked', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Marked', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Marked', 'url'=>array('admin')),
	array('label'=>'Disposal', 'url'=>array('disposal/create', 'docid'=>$model->document_id)),
);
?>

<h1>View Marked #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'document_id',
		'officer_id',
		'marked_by',
		'marked_date',
		'time_limit',
	),
)); ?>



