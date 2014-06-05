<?php
/* @var $this DocumentController */
/* @var $model Document */
/* @var $form CActiveForm */
?>

<div class="wide form">

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'diary_number'); ?>
		<?php echo $form->textField($model,'diary_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_received'); ?>
		<?php echo $form->textField($model,'date_received'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reference_number'); ?>
		<?php echo $form->textField($model,'reference_number',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_of_document'); ?>
		<?php echo $form->textField($model,'date_of_document'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'received_from'); ?>
		<?php echo $form->textField($model,'received_from',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
