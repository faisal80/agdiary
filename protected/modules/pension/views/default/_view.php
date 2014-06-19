<?php
/* @var $this DefaultController */
/* @var $data Pension */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diary_number')); ?>:</b>
	<?php echo CHtml::encode($data->diary_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('receipt_date')); ?>:</b>
	<?php echo CHtml::encode($data->receipt_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ref_number')); ?>:</b>
	<?php echo CHtml::encode($data->ref_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('issue_date')); ?>:</b>
	<?php echo CHtml::encode($data->issue_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('received_from')); ?>:</b>
	<?php echo CHtml::encode($data->received_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_name')); ?>:</b>
	<?php echo CHtml::encode($data->p_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_type')); ?>:</b>
	<?php echo CHtml::encode($data->pension_type->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('office_id')); ?>:</b>
	<?php echo CHtml::encode($data->office->name) .', '. CHtml::encode($data->office->station); ?>
	<br />

    <?php if(Yii::app()->user->name == 'admin') { ?>
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