<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'documents-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'diary_number'); ?>
		<?php echo $form->textField($model,'diary_number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'diary_number'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'reference_number'); ?>
		<?php echo $form->textField($model,'reference_number',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'reference_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_of_document'); ?>
		<?php  
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'model'=>$model,
				'attribute'=>'date_of_document',
				'value'=>$model->date_of_document,
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
		<?php echo $form->error($model,'date_of_document'); ?>
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
		<?php //echo $form->labelEx($model,'image'); ?>
		<?php //echo CHtml::activeFileField($model, 'image'); // by this we can upload image?>  
		<?php //echo $form->error($model,'image'); ?>
	        
		<?php
		  	$this->widget('CMultiFileUpload', array(
		  		'name' => 'images',
	     		//'model'=>$model,
	     		//'attribute'=>'files',
	     		'accept'=>'jpeg|jpg|gif|png',
		  		'duplicate' => 'File already selected!',
		  		'denied' => 'Invalid file type. Please select JPG/JPEG/GIF/PNG files only.',
			  ));
		?>
	</div>
	
	<?php if($model->isNewRecord!='1'){ ?>
		<div class="row">
		     <?php	foreach ($model->images as $key=>$image)		     		 
		     		{
		     			echo $form->hiddenField($model, '', array('name'=>$image->id .'-'. $image->document_id .'-'. $key, 'value'=>''));
		     			echo '<div class="imagebox" id="image' . $key . '">';		     			
		     			echo CHtml::image(Yii::app()->createUrl('../document_images/'.$image->image_path),$image->image_path,array("width"=>200));  // Image shown here if page is update page
		     			echo '<br><center><a href="#" id="remove' . $key .'" onclick="removeElement(getElementById(\'image'.$key.'\'), \''. $image->id .'-'. $image->document_id .'-'. $key. '\');">Remove</a></center>';
		     			echo '</div>'; 
//		     			echo '<script type="text/javascript">';
//						echo '$(document).ready(function(){
//								$("remove' . $key . '")
//									.click(function(){
//										$("#'. $image->id .'-'. $image->document_id .'-'. $key .'").val("deleted");
//										$("#image' . $key .'").remove();
//		     						});
//		     					});';
//						echo '</script>';
		     		}
		     ?>
		</div>
	<?php } ?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
/*<![CDATA[*/
function removeElement(ele, hele) {
	ele.parentNode.removeChild(ele);
	var hf = document.getElementById(hele);
	hf.value = "delete";
	window.alert (hf.name + " " + hf.value);
}
/*]]>*/
</script>