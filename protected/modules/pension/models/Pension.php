<?php

/**
 * This is the model class for table "{{pension}}".
 *
 * The followings are the available columns in table '{{pension}}':
 * @property integer $id
 * @property string $diary_number
 * @property string $receipt_date
 * @property string $ref_number
 * @property string $issue_date
 * @property string $received_from
 * @property string $description
 * @property string $p_name
 * @property string $p_type
 * @property integer $office_id
 * @property string $create_time
 * @property integer $create_user
 * @property string $update_time
 * @property integer $update_user
 */
class Pension extends AGDiaryActiveRecord
{
    private $_pension_types = array(
        1 => 'Retiring',
        2 => 'Superannuation',
        3 => 'Invalid',
        4 => 'Family',
        5 => 'Compensation',
        6 => 'Anticpatory',
        7 => 'Gratuity',
        8 => 'Extraordinary',
    );
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{pension}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('receipt_date, ref_number, issue_date, received_from, office_id, create_user, update_user', 'required'),
			array('office_id, create_user, update_user', 'numerical', 'integerOnly'=>true),
			array('diary_number', 'length', 'max'=>10),
			array('ref_number, received_from, p_name', 'length', 'max'=>255),
			array('p_type', 'length', 'max'=>50),
			array('description, create_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, diary_number, receipt_date, ref_number, issue_date, received_from, description, p_name, p_type, office_id, create_time, create_user, update_time, update_user', 'safe', 'on'=>'search'),
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
            'office'=> array(self::BELONGS_TO, 'Office', 'office_id'),
            'c_user'=> array(self::BELONGS_TO, 'Users', 'create_user'),
            'u_user'=> array(self::BELONGS_TO, 'Users', 'update_user'),
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
			'receipt_date' => 'Receipt Date',
			'ref_number' => 'Reference Number',
			'issue_date' => 'Issue Date',
			'received_from' => 'Received From',
			'description' => 'Description',
			'p_name' => 'Pensioner Name',
			'p_type' => 'Pension Type',
			'office_id' => 'Office',
			'create_time' => 'Create Time',
			'create_user' => 'Create User',
			'update_time' => 'Update Time',
			'update_user' => 'Update User',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('diary_number',$this->diary_number,true);
		$criteria->compare('receipt_date',$this->receipt_date,true);
		$criteria->compare('ref_number',$this->ref_number,true);
		$criteria->compare('issue_date',$this->issue_date,true);
		$criteria->compare('received_from',$this->received_from,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('p_name',$this->p_name,true);
		$criteria->compare('p_type',$this->p_type,true);
		$criteria->compare('office_id',$this->office_id);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user',$this->create_user);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user',$this->update_user);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pension the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    protected function beforeValidate() {
        if ($this->isNewRecord)
        {
            $this->receipt_date=new CDbExpression('NOW()');
            $this->office_id = Yii::app()->user->getState('officer_id');
        }
        
        parent::beforeValidate();
    }
    
    protected function afterFind ()
    {
        list($y, $m, $d) = explode('-', $this->receipt_date);
        $mk=mktime(0, 0, 0, $m, $d, $y);
        $this->receipt_date = date ('d-m-Y', $mk);
        
        list($y, $m, $d) = explode('-', $this->issue_date);
        $mk=mktime(0, 0, 0, $m, $d, $y);
        $this->issue_date = date ('d-m-Y', $mk);
        
        
        return parent::afterFind ();
    }

    protected function beforeSave ()
    {
        list($d, $m, $y) = explode('-', $this->issue_date);
        $mk=mktime(0, 0, 0, $m, $d, $y);
        $this->issue_date = date ('Y-m-d', $mk);
                
        return parent::beforeSave ();
    }    
    
    public static function getPensionTypeOptions()
    {
        return Pension::model()->_pension_types;
    }
}
