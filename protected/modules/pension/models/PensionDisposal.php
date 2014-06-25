<?php

/**
 * This is the model class for table "{{mod_pension_disposal}}".
 *
 * The followings are the available columns in table '{{mod_pension_disposal}}':
 * @property integer $id
 * @property string $disposal_date
 * @property string $disposal
 * @property integer $finalized
 * @property integer $p_id Pension case ID
 * @property string $create_time
 * @property integer $create_user
 * @property string $update_time
 * @property integer $update_user
 */
class PensionDisposal extends AGDiaryActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{mod_pension_disposal}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_user, update_user, p_id', 'required'),
			array('finalized, create_user, update_user', 'numerical', 'integerOnly'=>true),
            array('finazlied', 'isFinalized'),
			array('disposal_date, disposal, create_time, update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, disposal_date, disposal, finalized, create_time, create_user, update_time, update_user', 'safe', 'on'=>'search'),
		);
	}

    /**
    * @param string $attribute the name of the attribute to be validated
    * @param array $params options specified in the validation rule
    */
    public function isFinalized($attribute,$params) 
    {
        $dd = PensionDisposal::model()->findAll('p_id='. $this->p_id);
        if (!empty($dd) && $this->finalized)
        {
            foreach ($dd as $rr )
            {
                if ($rr->finalized && $this->finalized)
                {
                    $this->addError('finalized', 'The case has already been marked as finalized.');
                    return;
                }
            }
        }
    }
    
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'pension'=>array(self::BELONGS_TO, 'Pension', 'p_id'),
            'c_user'=>array(self::BELONGS_TO, 'Users', 'create_user'),
            'u_user'=>array(self::BELONGS_TO, 'Users', 'update_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'disposal_date' => 'Disposal Date',
			'disposal' => 'Disposal',
			'finalized' => 'Finalized',
            'p_id' => 'Pension Case ID',
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
		$criteria->compare('disposal_date',$this->disposal_date,true);
		$criteria->compare('disposal',$this->disposal,true);
		$criteria->compare('finalized',$this->finalized);
        $criteria->compare('p_id', $this->p_id, true);
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
	 * @return PensionDisposal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
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
