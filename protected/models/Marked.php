<?php

/**
 * This is the model class for table "{{marked}}".
 *
 * The followings are the available columns in table '{{marked}}':
 * @property string $id
 * @property string $document_id
 * @property string $officer_id
 * @property string $marked_by
 * @property string $marked_date
 * @property string $time_limit
 * @property string $create_time
 * @property integer $create_user
 * @property string $update_time
 * @property integer $update_user
 *
 * The followings are the available model relations:
 * @property Documents $document
 * @property Officers $officer
 * @property Officers $markedBy
 */
class Marked extends AGDiaryActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Marked the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{marked}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('document_id, officer_id, marked_by, create_time, create_user, update_user', 'required'),
			array('create_user, update_user', 'numerical', 'integerOnly'=>true),
			array('document_id, officer_id, marked_by, time_limit', 'length', 'max'=>10),
			array('marked_date, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, document_id, officer_id, marked_by, marked_date, time_limit, create_time, create_user, update_time, update_user', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'document' => array(self::BELONGS_TO, 'Documents', 'document_id'),
			'officer' => array(self::BELONGS_TO, 'Officers', 'officer_id'),
			'markedBy' => array(self::BELONGS_TO, 'Officers', 'marked_by'),
            'c_user' => array(self::BELONGS_TO, 'Users', 'create_user'),
            'u_user' => array(self::BELONGS_TO, 'Users', 'update_user'),
        
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'document_id' => 'Document',
			'officer_id' => 'Officer',
			'marked_by' => 'Marked By',
			'marked_date' => 'Marked Date',
			'time_limit' => 'Time Limit',
			'create_time' => 'Create Time',
			'create_user' => 'Create User',
			'update_time' => 'Update Time',
			'update_user' => 'Update User',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('document_id',$this->document_id,true);
		$criteria->compare('officer_id',$this->officer_id,true);
		$criteria->compare('marked_by',$this->marked_by,true);
		$criteria->compare('marked_date',$this->marked_date,true);
		$criteria->compare('time_limit',$this->time_limit,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user',$this->create_user);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user',$this->update_user);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**	
	 * Gets the officer id attached to this user and assign it to marked_by property
	 */
	protected function beforeValidate()
	{
		if($this->isNewRecord)
		{
			// set the create date, last updated date and the user doing the creating
			//$this->create_time=$this->update_time=new CDbExpression('NOW()');
			$_user = Users::model()->findByPk(Yii::app()->user->id);
			$this->marked_by=$_user->officer_id;
		}
		/*else
		{
			//not a new record, so just set the last updated time and last updated user id
			$this->update_time=new CDbExpression('NOW()');
			$this->update_user_id=Yii::app()->user->id;
		}*/
		return parent::beforeValidate();
	}
    protected function afterFind ()
    {
        list($y, $m, $d) = explode('-', $this->marked_date);
        $mk=mktime(0, 0, 0, $m, $d, $y);
        $this->marked_date = date ('d-m-Y', $mk);
        
        /*list($y, $m, $d) = explode('-', $this->date_of_document);
        $mk=mktime(0, 0, 0, $m, $d, $y);
        $this->date_of_document = date ('d-m-Y', $mk);*/
        
        
        return parent::afterFind ();
    }

    protected function afterSave()
    {
    	$_document = $this->document;
    	if ($_document->isOfficerInDocument($this->officer_id))
    		$_document->associateOfficerToRole('follower', $this->officer_id);
    	
    	parent::afterSave();
    }
    protected function beforeSave ()
    {
        list($d, $m, $y) = explode('-', $this->marked_date);
        $mk=mktime(0, 0, 0, $m, $d, $y);
        $this->marked_date = date ('Y-m-d', $mk);
                
        return parent::beforeSave ();
    }   
    /**
     * @return string the status text display for the current issue
     */ 
  	public function getOfficerText()
  	{
    	return $this->officer->title;
  	}
}