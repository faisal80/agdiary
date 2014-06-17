<?php
/* @var $this DefaultController */
/* @var $model Pension */

$this->breadcrumbs=array(
	'Pensions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Pension', 'url'=>array('index')),
	array('label'=>'Create Pension', 'url'=>array('create')),
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

<h1>Manage Pensions</h1>

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
		/*
		'description',
		'p_name',
		'p_type',
		'office_id',
		'create_time',
		'create_user',
		'update_time',
		'update_user',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
