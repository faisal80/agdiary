<?php
$this->breadcrumbs=array(
	'Officers'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Officers', 'url'=>array('index')),
	array('label'=>'Create Officers', 'url'=>array('create')),
	array('label'=>'Update Officers', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Officers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Officers', 'url'=>array('admin')),
);
?>

<h1>View Officers #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'level',
	),
)); ?>
