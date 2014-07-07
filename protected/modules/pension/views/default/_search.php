<?php
/* @var $this DefaultController */
/* @var $model Pension */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'diary_number'); ?>
		<?php echo $form->textField($model,'diary_number',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'receipt_date'); ?>
		<?php echo $form->textField($model,'receipt_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ref_number'); ?>
		<?php echo $form->textField($model,'ref_number',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'issue_date'); ?>
		<?php echo $form->textField($model,'issue_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'received_from'); ?>
		<?php echo $form->textField($model,'received_from',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_name'); ?>
		<?php echo $form->textField($model,'p_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'p_type'); ?>
		<?php echo $form->textField($model,'p_type',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'office_id'); ?>
		<?php echo $form->textField($model,'office_id'); ?>
	</div>

    <?php if (Yii::app()->user->name =='admin') { ?>
	<div class="row">
		<?php echo $form->label($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_user'); ?>
		<?php echo $form->textField($model,'create_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_time'); ?>
		<?php echo $form->textField($model,'update_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_user'); ?>
		<?php echo $form->textField($model,'update_user'); ?>
	</div>
    <?php } ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->