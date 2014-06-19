<?php
/* @var $this DisposalController */
/* @var $model PensionDisposal */

$this->breadcrumbs=array(
	'Pension Disposals'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PensionDisposal', 'url'=>array('index')),
	array('label'=>'Create PensionDisposal', 'url'=>array('create')),
	array('label'=>'Update PensionDisposal', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PensionDisposal', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PensionDisposal', 'url'=>array('admin')),
);
?>

<h1>View Pension Case Disposal #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'disposal_date',
		'disposal',
		'finalized:boolean',
		'create_time'=>array(
            'name'=>'create_time',
            'visible'=>  Yii::app()->user->name == 'admin',
        ),
		'create_user'=>array(
            'name'=>'c_user.username',
            'visible'=>  Yii::app()->user->name == 'admin',
        ),
		'update_time'=>array(
            'name'=>'update_time',
            'visible'=>  Yii::app()->user->name == 'admin',
        ),
		'update_user'=>array(
            'name'=>'u_user.username',
            'visible'=>  Yii::app()->user->name == 'admin',
        ),
	),
)); ?>
