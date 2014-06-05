<?php
$this->breadcrumbs=array(
	'Documents'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Document', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('documents-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Documents</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'documents-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'id',
		'diary_number',
		'date_received',
		'reference_number',
		'date_of_document',
		'received_from',
		'description',
		array(
			'class'=>'CButtonColumn',
            'header'=>'Actions',
			'template'=>'{view}{update}',
//			'buttons'=>array(
//				'delete'=>array(
//					'visible'=>'Yii::app()->user->checkAccess("delete")? true : false',
//				),
//			),
		),
	),
)); ?>
