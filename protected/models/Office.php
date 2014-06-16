<?php

/**
 * This is the model class for table "{{office}}".
 *
 * The followings are the available columns in table '{{office}}':
 * @property integer $id
 * @property string $name
 * @property string $station
 * @property string $create_time
 * @property integer $create_user
 * @property string $update_time
 * @property integer $update_user
 */
class Office extends AGDiaryActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Office the static model class
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
		return '{{office}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, station, create_user, update_time, update_user', 'required'),
			array('create_user, update_user', 'numerical', 'integerOnly'=>true),
			array('name, station', 'length', 'max'=>100),
			array('create_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, station, create_time, create_user, update_time, update_user', 'safe', 'on'=>'search'),
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
            'officers'=>array(self::HAS_MANY, 'Officers', 'office_id'),
            'users'=>array(self::HAS_MANY, 'Users', 'office_id'),
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
			'name' => 'Name',
			'station' => 'Station',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('station',$this->station,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user',$this->create_user);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user',$this->update_user);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}