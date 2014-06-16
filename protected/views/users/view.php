<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
	array('label'=>'Update Users', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Users', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>View Users #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'officer.title',
        array(
            'label'=>'Office',
            'name'=>'office.name',
        ),
        array(
            'label'=>'Station',
            'name'=>'office.station',
        ),
        'create_time',
        'create_user'=>array(
            'label'=>'Create User',
            'name'=>'c_user.username',
        ),
        'update_time',
        'update_user'=>array(
            'label'=>'Update User',
            'name'=>'u_user.username',
        ),
	),
)); ?>
