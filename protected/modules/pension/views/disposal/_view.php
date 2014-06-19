<?php
/* @var $this DisposalController */
/* @var $data PensionDisposal */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('disposal_date')); ?>:</b>
	<?php echo CHtml::encode($data->disposal_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('disposal')); ?>:</b>
	<?php echo CHtml::encode($data->disposal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('finalized')); ?>:</b>
	<?php echo CHtml::encode(($data->finalized)? 'Yes': 'No'); ?>
	<br />

    <?php if (Yii::app()->user->name == 'admin') { ?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user')); ?>:</b>
	<?php echo CHtml::encode($data->c_user->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_user')); ?>:</b>
	<?php echo CHtml::encode($data->u_user->username); ?>
	<br />

    <?php }; ?>

</div>