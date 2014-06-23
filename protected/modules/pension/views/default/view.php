<?php
/* @var $this DefaultController */
/* @var $model Pension */

$this->breadcrumbs=array(
	'Pension Cases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Pension Cases', 'url'=>array('index')),
	array('label'=>'Enter New Pension Case', 'url'=>array('create')),
	array('label'=>'Update Pension Case', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'Enter Disposal', 'url'=>array('disposal/create', 'p'=>$model->id)),
	array('label'=>'Delete Pension Case', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pension Cases', 'url'=>array('admin')),
);
?>

<h1>Pension Case #<?php echo $model->id; ?></h1>

<?php MyFunctions::Navigation($model, $count, $this);  ?>

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
		'pension_type.type',
		'office'=>array(
            'label'=>'Office',
            'name'=>'office.name',
        ),
        'station'=>array(
            'label'=>'Station',
            'name'=>'office.station',
        ),
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

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pension-disposal-grid',
	'dataProvider'=>$disposal,
	'columns'=>array(
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
            'name'=>'c_user.username',
            'visible'=>  Yii::app()->user->name == 'admin',
        ),
		array(
            'class'=>'CButtonColumn',
            'template'=>'{update} {delete}',
            //'viewButtonUrl'=> 'Yii::app()->createUrl("disposal/view", array("id"=>$data->id))',
            'updateButtonUrl'=> 'Yii::app()->createUrl("pension/disposal/update", array("id"=>$data->id))',
            'deleteButtonUrl'=> 'Yii::app()->createUrl("pension/disposal/delete", array("id"=>$data->id))',		),
	),
)); ?>