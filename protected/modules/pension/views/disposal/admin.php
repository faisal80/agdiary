<?php
/* @var $this DisposalController */
/* @var $model PensionDisposal */

$this->breadcrumbs=array(
	'Pension Disposals'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List PensionDisposal', 'url'=>array('index')),
	array('label'=>'Create PensionDisposal', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pension-disposal-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Pension Disposals</h1>

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
	'id'=>'pension-disposal-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
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
