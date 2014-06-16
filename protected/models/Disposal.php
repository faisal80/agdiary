<?php

/**
 * This is the model class for table "{{disposal}}".
 *
 * The followings are the available columns in table '{{disposal}}':
 * @property string $id
 * @property string $document_id
 * @property string $officer_id
 * @property string $disposal_date
 * @property string $disposal
 * @property string $create_time
 * @property integer $create_user
 * @property string $update_time
 * @property integer $update_user

 *
 * The followings are the available model relations:
 * @property Documents $document
 * @property Officers $officer
 */
class Disposal extends AGDiaryActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Disposal the static model class
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
		return '{{disposal}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('document_id, officer_id, create_time, create_user, update_user', 'required'),
			array('create_user, update_user', 'numerical', 'integerOnly'=>true),
			array('document_id, officer_id', 'length', 'max'=>10),
			array('disposal_date, disposal, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, document_id, officer_id, disposal_date, disposal, create_time, create_user, update_time, update_user', 'safe', 'on'=>'search'),
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
			'disposal_date' => 'Disposal Date',
			'disposal' => 'Disposal',
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
		$criteria->compare('disposal_date',$this->disposal_date,true);
		$criteria->compare('disposal',$this->disposal,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user',$this->create_user);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user',$this->update_user);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    protected function afterFind ()
    {
        list($y, $m, $d) = explode('-', $this->disposal_date);
        $mk=mktime(0, 0, 0, $m, $d, $y);
        $this->disposal_date = date ('d-m-Y', $mk);
        
        return parent::afterFind ();
    }

    protected function beforeSave ()
    {
        list($d, $m, $y) = explode('-', $this->disposal_date);
        $mk=mktime(0, 0, 0, $m, $d, $y);
        $this->disposal_date = date ('Y-m-d', $mk);
                
        return parent::beforeSave ();
    }   
}