<?php
/* @var $this DisposalController */
/* @var $model PensionDisposal */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pension-disposal-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'disposal_date'); ?>
		<?php  
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				'attribute'=>'disposal_date',
				'value'=>$model->disposal_date,
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
		<?php echo $form->error($model,'disposal_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'disposal'); ?>
		<?php echo $form->textArea($model,'disposal',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'disposal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'finalized'); ?>
		<?php echo $form->checkBox($model,'finalized'); ?>
		<?php echo $form->error($model,'finalized'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->