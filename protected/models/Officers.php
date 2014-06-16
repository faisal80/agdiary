<?php

/**
 * This is the model class for table "{{officers}}".
 *
 * The followings are the available columns in table '{{officers}}':
 * @property string $id
 * @property string $title
 * @property string $level
 * @property string $create_time
 * @property integer $create_user
 * @property string $update_time
 * @property integer $update_user
 *
 * The followings are the available model relations:
 * @property Disposal[] $disposals
 * @property Marked[] $markeds
 * @property Marked[] $markeds1
 * @property Users[] $users
 */
class Officers extends AGDiaryActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Officers the static model class
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
		return '{{officers}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_time, create_user, update_user', 'required'),
			array('create_user, update_user', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('level, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, level, create_time, create_user, update_time, update_user', 'safe', 'on'=>'search'),
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
			'disposals' => array(self::HAS_MANY, 'Disposal', 'officer_id'),
			'markeds' => array(self::HAS_MANY, 'Marked', 'officer_id'),
			'markeds1' => array(self::HAS_MANY, 'Marked', 'marked_by'),
			'users' => array(self::HAS_MANY, 'Users', 'officer_id'),
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
			'title' => 'Title',
			'level' => 'Level',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('level',$this->level,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user',$this->create_user);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user',$this->update_user);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Officers::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * Returns the title of the officer
	 * @param integer the ID of the officer to find 
	 */
	public function getOfficerTitle($id)
	{
		$_model = $this->loadModel($id);
		return $_model->title;
	}
	
}
