<?php
$this->breadcrumbs=array(
	'Markeds'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Back', 'url'=>array('documents/view', 'id'=>$model->document_id)),
);
?>

<h1>Update Marked <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>