<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'disposal-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->hiddenField($model,'document_id'); ?>
	</div>
	<?php $_user = Users::model()->findByPk(Yii::app()->user->id)?>
	<div class="row">
		<?php echo $form->labelEx($model,'officer_id'); ?>
		<?php echo $form->dropDownList($model,'officer_id', Users::model()->getOfficersOptions(true), array('options'=>array($_user->getOfficerID()=>array('selected'=>'selected')))); ?>
		<?php echo $form->error($model,'officer_id'); ?>
	</div>

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

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->