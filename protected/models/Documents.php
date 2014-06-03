<?php

/**
 * This is the model class for table "{{documents}}".
 *
 * The followings are the available columns in table '{{documents}}':
 * @property string $id
 * @property integer $diary_number
 * @property string $date_received
 * @property string $reference_number
 * @property string $date_of_document
 * @property string $received_from
 * @property string $description
 * @property string $create_time
 * @property integer $create_user
 * @property string $update_time
 * @property integer $update_user
 *
 * The followings are the available model relations:
 * @property Disposal[] $disposals
 * @property Marked[] $markeds
 */
class Documents extends AGDiaryActiveRecord
{
	
	public $officer_title;
	public $image;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Documents the static model class
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
		return '{{documents}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('received_from, description', 'required'),
			array('diary_number', 'numerical', 'integerOnly'=>true),
			array('reference_number, received_from', 'length', 'max'=>255),
			array('description, date_of_document', 'safe'),
			array('image', 'file', 'types'=>'jpg, gif, png', 'allowEmpty'=>true),
			//array('date_received, date_of_document', 'date', 'format'=>'yyyy-MM-dd'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, diary_number, date_received, reference_number, date_of_document, received_from, description', 'safe', 'on'=>'search'),
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
			'disposals' => array(self::HAS_MANY, 'Disposal', 'document_id'),
			'markeds' => array(self::HAS_MANY, 'Marked', 'document_id'),
			'officers' => array(self::MANY_MANY, 'Officers', 'tbl_marked(document_id, officer_id)'),
			'comment' => array(self::HAS_ONE, 'Comments', 'document_id'),
			'images' => array(self::HAS_MANY, 'DocumentImages', 'document_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'diary_number' => 'Diary Number',
			'date_received' => 'Date Received',
			'reference_number' => 'Reference Number',
			'date_of_document' => 'Date of Document',
			'received_from' => 'Received From',
			'description' => 'Description',
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

		// Formats the date as required by DB
		if ($this->date_received<>'')
		{
			list($d, $m, $y) = explode('-', $this->date_received);
        	$mk=mktime(0, 0, 0, $m, $d, $y);
        	$this->date_received = date ('Y-m-d', $mk);
		}
        
		if ($this->date_of_document<>'')
		{
			list($d, $m, $y) = explode('-', $this->date_of_document);
        	$mk=mktime(0, 0, 0, $m, $d, $y);
        	$this->date_of_document = date ('Y-m-d', $mk);
		}
        
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('diary_number',$this->diary_number,true);
		$criteria->compare('date_received',$this->date_received,true);
		$criteria->compare('reference_number',$this->reference_number,true);
		$criteria->compare('date_of_document',$this->date_of_document,true);
		$criteria->compare('received_from',$this->received_from,true);
		$criteria->compare('description',$this->description,true);
		//$criteria->compare('officer_id', Users::model()->getOfficerID(), true);
//		$criteria->compare('create_time',$this->create_time,true);
//		$criteria->compare('create_user',$this->create_user);
//		$criteria->compare('update_time',$this->update_time,true);
//		$criteria->compare('update_user',$this->update_user);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));

//		$_sql = "SELECT * 
//				 FROM `tbl_documents` 
//				 INNER JOIN `tbl_marked` ON `tbl_documents`.`id`=`tbl_marked`.`document_id` 
//				 WHERE `tbl_marked`.`officer_id`=3";
//		$_rtModel = Documents::model()->findBySql($_sql);
		
//		return $_rtModel;
	}
	
	/**	
	 * Saves the current timestamp in the date received field
	 */
	protected function beforeValidate()
	{
		//if($this->isNewRecord)
		//{
			// set the create date, last updated date and the user doing the creating
			//$this->create_time=$this->update_time=new CDbExpression('NOW()');
			//$_user = Users::model()->findByPk(Yii::app()->user->id);
			$this->date_received=new CDbExpression('NOW()');
			//$this->date_of_document=date('Y-m-d', strtotime($this->date_of_document));
			
		//}
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
        list($y, $m, $d) = explode('-', $this->date_received);
        $mk=mktime(0, 0, 0, $m, $d, $y);
        $this->date_received = date ('d-m-Y', $mk);
        
        list($y, $m, $d) = explode('-', $this->date_of_document);
        $mk=mktime(0, 0, 0, $m, $d, $y);
        $this->date_of_document = date ('d-m-Y', $mk);
        
        
        return parent::afterFind ();
    }

    protected function beforeSave ()
    {
        list($d, $m, $y) = explode('-', $this->date_of_document);
        $mk=mktime(0, 0, 0, $m, $d, $y);
        $this->date_of_document = date ('Y-m-d', $mk);
                
        return parent::beforeSave ();
    }

    protected function afterSave()
    {
    	//add creator role current officer in the current document context
    	$this->associateOfficerToRole('creator', Users::model()->getOfficerID());
    	
    	return parent::afterSave();
    }
	/**
	 * creates an association between the document, the officer and the officer's role within the document
	 */
	public function associateOfficerToRole($role, $officerId)
	{
		$sql =	"SELECT document_id, officer_id, role FROM tbl_document_officer_role 
				WHERE document_id=:documentId
					AND officer_id=:officerId
					AND role=:role";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":documentId", $this->id, PDO::PARAM_INT);
		$command->bindValue(":officerId", $officerId, PDO::PARAM_INT);
		$command->bindValue(":role", $role, PDO::PARAM_STR);
		
		if (!$command->execute())
		{
			$sql = "INSERT INTO tbl_document_officer_role (document_id, officer_id, role) 
					VALUES (:documentId, :officerId, :role)";
			$command = Yii::app()->db->createCommand($sql);
			$command->bindValue(":documentId", $this->id, PDO::PARAM_INT);
			$command->bindValue(":officerId", $officerId, PDO::PARAM_INT);
			$command->bindValue(":role", $role, PDO::PARAM_STR);
			return $command->execute();
		}
		return false;
	}
	
	/**
	 * removes an association between the document, the officer and the officer's role within the document
	 */
	public function removeOfficerFromRole($role, $officerId)
	{
		$sql = "DELETE FROM tbl_document_officer_role 
				WHERE document_id=:documentId AND officer_id=:officerId AND role=:role";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":documentId", $this->id, PDO::PARAM_INT);
		$command->bindValue(":officerId", $officerId, PDO::PARAM_INT);
		$command->bindValue(":role", $role, PDO::PARAM_STR);
		return $command->execute();
	}
	
	/**
	 * @return boolean whether or not the current officer is in the specified role within the context of this document
	 */
	public function isOfficerInRole($role)
	{
		$sql = "SELECT role FROM tbl_document_officer_role 
				WHERE document_id=:documentId AND officer_id=:officerId AND role=:role";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":documentId", $this->id, PDO::PARAM_INT);
		$command->bindValue(":officerId", Users::model()->getOfficerID(), PDO::PARAM_INT);
		$command->bindValue(":role", $role, PDO::PARAM_STR);
		return $command->execute()==1 ? true : false;
	}
	
	/**
	 * Determines whether or not a officer is already marked the document
	 */
	public function isOfficerInDocument($officerID)
	{
		$sql = "SELECT officer_id FROM tbl_marked WHERE document_id=:documentID AND officer_id=:officerID AND marked_by=:markedBy";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":documentID", $this->id, PDO::PARAM_INT);
		$command->bindValue(":officerID", $officerID, PDO::PARAM_INT);
		$command->bindValue(":markedBy", Users::model()->getOfficerID(), PDO::PARAM_INT);
		return $command->execute()==1 ? true : false;
	}
}