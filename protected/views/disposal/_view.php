<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('document_id')); ?>:</b>
	<?php echo CHtml::encode($data->document_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('officer_id')); ?>:</b>
	<?php echo CHtml::encode($data->officer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('disposal_date')); ?>:</b>
	<?php echo CHtml::encode($data->disposal_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('disposal')); ?>:</b>
	<?php echo CHtml::encode($data->disposal); ?>
	<br />


</div>