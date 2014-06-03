<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('marked/view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('document_id')); ?>:</b>
	<?php echo CHtml::encode($data->document_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('officer_id')); ?>:</b>
	<?php echo CHtml::encode($data->getOfficerText()); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('marked_by')); ?>:</b>
	<?php echo CHtml::encode($data->marked_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('marked_date')); ?>:</b>
	<?php echo CHtml::encode($data->marked_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time_limit')); ?>:</b>
	<?php echo CHtml::encode($data->time_limit); ?>
	<br />


</div>