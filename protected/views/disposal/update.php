<?php
$this->breadcrumbs=array(
	'Disposals'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
//	array('label'=>'List Disposal', 'url'=>array('index')),
//	array('label'=>'Create Disposal', 'url'=>array('create')),
	array('label'=>'Back', 'url'=>array('documents/view', 'id'=>$model->id)),
//	array('label'=>'Manage Disposal', 'url'=>array('admin')),
);
?>

<h1>Update Disposal <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>