<?php
/* @var $this DisposalController */
/* @var $model PensionDisposal */
/* @var $p_id Pension case ID */

$this->breadcrumbs=array(
	'Pension Cases'=>array('default/index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pension Cases', 'url'=>array('default/index')),
	array('label'=>'Manage Pension Cases', 'url'=>array('default/admin')),
    array('label'=>'View Pension Case', 'url'=>array('default/view', 'id'=>$p_id)),
);
?>

<h1>Enter Disposal of Pension Case ID No. <?php echo $p_id; ?> in respect of <?php echo Pension::model()->findByPk($p_id)->p_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>