<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'marked-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->hiddenField($model,'document_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'officer_id'); ?>
		<?php echo $form->dropDownList($model,'officer_id', Users::model()->getOfficersOptions()); ?>
		<?php echo $form->error($model,'officer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'marked_date'); ?>
		<?php  
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				'attribute'=>'marked_date',
				'value'=>$model->marked_date,
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
		<?php echo $form->error($model,'marked_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'time_limit'); ?>
		<?php echo $form->textField($model,'time_limit',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'time_limit'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->