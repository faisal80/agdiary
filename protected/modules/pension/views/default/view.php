<?php
/* @var $this DefaultController */
/* @var $model Pension */

$this->breadcrumbs=array(
	'Pensions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Pension', 'url'=>array('index')),
	array('label'=>'Create Pension', 'url'=>array('create')),
	array('label'=>'Update Pension', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Pension', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pension', 'url'=>array('admin')),
);
?>

<h1>View Pension #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'diary_number',
		'receipt_date',
		'ref_number',
		'issue_date',
		'received_from',
		'description',
		'p_name',
		'p_type',
		'office_id',
		'create_time',
		'create_user',
		'update_time',
		'update_user',
	),
)); ?>
