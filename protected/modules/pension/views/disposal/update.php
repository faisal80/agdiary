<?php
/* @var $this DisposalController */
/* @var $model PensionDisposal */

$this->breadcrumbs=array(
	'Pension Disposals'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PensionDisposal', 'url'=>array('index')),
	array('label'=>'Create PensionDisposal', 'url'=>array('create')),
	array('label'=>'View PensionDisposal', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PensionDisposal', 'url'=>array('admin')),
);
?>

<h1>Update PensionDisposal <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>