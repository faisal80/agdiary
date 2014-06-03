<?php
$this->breadcrumbs=array(
	'Markeds'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Back', 'url'=>array('documents/view', 'id'=>$model->document_id)),
);
?>

<h1>Document #<?php echo $model->document_id?> marked to</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>