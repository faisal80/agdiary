<?php
/* @var $this DefaultController */
/* @var $model Pension */

$this->breadcrumbs=array(
	'Pension Cases'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Pension Cases', 'url'=>array('index')),
	array('label'=>'Enter New Pension Case', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pension-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Pension Cases</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pension-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
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
            'header'=>'Office',
            'type'=>'raw',
            'value'=>'$data->office->name .", ". $data->office->station',
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
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
