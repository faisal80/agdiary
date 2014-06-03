<?php
$this->breadcrumbs=array(
	'Documents'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Documents', 'url'=>array('index')),
	array('label'=>'Create Document', 'url'=>array('create')),
	array('label'=>'Update Document', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Document', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Documents', 'url'=>array('admin')),
	array('label'=>'Marked to', 'url'=>array('marked/create', 'docid'=>$model->id)),
	array('label'=>'Disposal', 'url'=>array('disposal/create', 'docid'=>$model->id)),
	isset($model->images[0]) ? array('label'=>'View Document', 'url'=>'#', 'linkOptions'=>array('onclick'=>'$("#attachment_dialog").dialog("open"); return false;')): '',
	);
?>

<h1>View Document #<?php echo $model->id; ?></h1>
<p align="right">
	<?php 
	if ($model->id > 1)
	{
		echo CHtml::link('Previous', $this->createUrl('view', array('id'=>($model->id - 1)))) . ' | ';
	} 
	echo CHtml::link('Next', $this->createUrl('view', array('id'=>($model->id + 1))));
	
	?> 
</p>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'diary_number',
		'date_received',
		'reference_number',
		'date_of_document',
		'received_from',
		'description',
	),
)); 
if ($model->comment)
{
	echo "<BR><div class='notice'  style='	color:red;  
											border-color:black;
											float:left;
											font-weight: bold;
											font-size: 12pt;'>
											<span style='width:100px; display:inline;'>AG's Comments: </span>
											<span style='width:100px; display:inline;'><p>" . $model->comment->comment . "</p></span></div><br><br>";
}
?>

<br>
<?php 
	//displays the officer to whom the document is marked
	$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => $markedDataProvider,
		'columns'=> array(
			array(
				'header'=>'Marked to',
				'name' =>'officer.title',
			),
			'marked_date',
			array(
				'header'=>'Marked By',
				'name' =>'markedBy.title',
			),
			array(
				'class'=>'CButtonColumn',
				'template'=>'{update} {delete}',
				//'viewButtonUrl'=> 'Yii::app()->createUrl("marked/view", array("id"=>$data->id))',
				'updateButtonUrl'=> 'Yii::app()->createUrl("marked/update", array("id"=>$data->id))',
				'deleteButtonUrl'=> 'Yii::app()->createUrl("marked/delete", array("id"=>$data->id))',						
			),
		),
	));

	$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => $disposalDataProvider,
		'columns'=> array(
			array(
				'name' => 'officer.title',
				'header'=>'Disposed Off by',
			),
			'disposal_date',
			'disposal',
			array(
				'class'=>'CButtonColumn',
				'template'=>'{update} {delete}',
				//'viewButtonUrl'=> 'Yii::app()->createUrl("disposal/view", array("id"=>$data->id))',
				'updateButtonUrl'=> 'Yii::app()->createUrl("disposal/update", array("id"=>$data->id))',
				'deleteButtonUrl'=> 'Yii::app()->createUrl("disposal/delete", array("id"=>$data->id))',						
			),
		)
	));
	
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	    'id'=>'attachment_dialog',
	    // additional javascript options for the dialog plugin
	    'options'=>array(
	        'title'=>'Attachments',
	        'autoOpen'=>false,
			'maxWidth'=>900,
			'minWidth'=>500,
			'maxHeight'=>600,
			'minHeight'=>200,
			'width'=>935,
			'height'=>600,
			'modal'=>true,
	    ),
	));
	
		$number_of_images = count($model->images);
		for($i=0; $i<$number_of_images; $i++)
			echo CHtml::image(Yii::app()->createUrl('../document_images/'.$model->images[$i]->image_path)) . '<br><hr><br>';  // Image shown here if page is update page
	
	$this->endWidget('zii.widgets.jui.CJuiDialog');
	
	// the link that may open the dialog
//	echo CHtml::link('View Document', '#', array(
//	   'onclick'=>'$("#attachment_dialog").dialog("open"); return false;',
//	));

?>