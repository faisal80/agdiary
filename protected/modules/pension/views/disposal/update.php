<?php
/* @var $this DisposalController */
/* @var $model PensionDisposal */

$this->breadcrumbs=array(
	'Pension Cases'=>array('default/index'),
	$model->p_id=>array('default/view','id'=>$model->p_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pension Cases', 'url'=>array('default/index')),
	array('label'=>'Enter New Pension Case', 'url'=>array('default/create')),
	array('label'=>'View Pension Case', 'url'=>array('default/view', 'id'=>$model->p_id)),
	array('label'=>'Manage Pension Cases', 'url'=>array('default/admin')),
);
?>

<h1>Update Pension Disposal for Pension Case ID. <?php echo $model->p_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>