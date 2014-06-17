<?php
/* @var $this PensionController */
/* @var $model Pension */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pension-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'diary_number'); ?>
		<?php echo $form->textField($model,'diary_number',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'diary_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ref_number'); ?>
		<?php echo $form->textField($model,'ref_number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'ref_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'issue_date'); ?>
		<?php  
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				'attribute'=>'issue_date',
				'value'=>$model->issue_date,
    			'options'=>array(
	       				'showAnim'=>'fold',
						'dateFormat'=>'dd-mm-yy',  //save to db
						'changeMonth' => true,
						'changeYear' => true,
						'showOn'=>'both',
	                    'buttonText'=>'...',
	    		),
    			'htmlOptions'=>array(
        			'style'=>'height:20px;',
    			),
			));
		?>
		<?php echo $form->error($model,'issue_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'received_from'); ?>
		<?php echo $form->textField($model,'received_from',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'received_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'p_name'); ?>
		<?php echo $form->textField($model,'p_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'p_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'p_type'); ?>
		<?php echo $form->dropDownList($model,'p_type',  Pension::model()->getPensionTypeOptions()); ?>
		<?php echo $form->error($model,'p_type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->