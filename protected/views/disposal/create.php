<?php
$this->breadcrumbs=array(
	'Disposals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Back', 'url'=>array('documents/view', 'id'=>$model->document_id)),
	array('label'=>'Manage Disposal', 'url'=>array('admin')),
);
?>

<h1>Create Disposal</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>