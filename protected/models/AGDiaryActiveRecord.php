<?php
abstract class AGDiaryActiveRecord extends CActiveRecord
{
	
	/**
	 * @return array of valid Officers for this document, indexed by officer IDs
	 */ 
	public function getOfficersOptions()
	{
		$_Officers = Officers::model()->findAll();
	  	$officersArray = CHtml::listData($_Officers, 'id', 'title');
	  	return $officersArray;
	}
	
	/**
	 * Prepares create_time, create_user, update_time and update_user attributes before performing validation.
	 */
  	protected function beforeValidate()
  	{	
      	if($this->isNewRecord)
    	{
	     	// set the create date, last updated date and the user doing the creating  
	      	$this->create_time=$this->update_time=new CDbExpression('NOW()');
	        $this->create_user=$this->update_user=Yii::app()->user->id;
        }
	    else
	    {
		 	//not a new record, so just set the last updated time and last updated user id     
      		$this->update_time=new CDbExpression('NOW()');
      		$this->update_user=Yii::app()->user->id;
    	}
    
    	return parent::beforeValidate();
    }
}