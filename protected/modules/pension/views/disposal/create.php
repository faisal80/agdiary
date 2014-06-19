<?php
/* @var $this DisposalController */
/* @var $model PensionDisposal */
/* @var $p_id Pension case ID */

$this->breadcrumbs=array(
	'Pension Disposals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PensionDisposal', 'url'=>array('index')),
	array('label'=>'Manage PensionDisposal', 'url'=>array('admin')),
);
?>

<h1>Enter Disposal of Pension Case ID No. <?php echo $p_id; ?> in respect of <?php echo Pension::model()->findByPk($p_id)->p_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>