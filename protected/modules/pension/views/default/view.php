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
    array('label'=>'Disposal', 'url'=>array('disposal/create', 'p'=>$model->id)),
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
		),
	),
)); ?>