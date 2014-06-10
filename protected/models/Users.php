<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $officer_id
 * @property string $office_id Office in which the user serve.
 * @property string $create_time
 * @property integer $create_user
 * @property string $update_time
 * @property integer $update_user
 *
 * The followings are the available model relations:
 * @property Officers $officer
 */
class Users extends AGDiaryActiveRecord
{
	
	public $password_repeat;
	public $newpasswd;
	public $newpasswd_repeat;
	
	private $_identity; 	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return '{{users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('officer_id, create_time, create_user, update_user, office_id', 'required'),
			array('username', 'unique', 'on'=>'update'),
			array('password', 'compare', 'on'=>'insert'),
			array('create_user, update_user', 'numerical', 'integerOnly'=>true),
            array('newpasswd', 'required', 'on'=>'changepwd'),
            array('newpasswd_repeat', 'compare', 'compareAttribute'=>'newpasswd', 'on'=>'changepwd'),
			array('username', 'length', 'max'=>100, 'on'=>'update'),
			array('password', 'length', 'max'=>255),
			array('officer_id', 'length', 'max'=>10),
			array('password_repeat, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, officer_id, office_id, create_time, create_user, update_time, update_user', 'safe', 'on'=>'search'),
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
			'officer' => array(self::BELONGS_TO, 'Officers', 'officer_id'),
            'office' => array(self::BELONGS_TO, 'Office', 'office_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'officer_id' => 'Attached with Officer',
            'office_id' => 'Office',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('officer_id',$this->officer_id,true);
        $criteria->compare('office_id',$this->office_id,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user',$this->create_user);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user',$this->update_user);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return array of valid Officers for this document, indexed by officer IDs
	 */ 
	public function getOfficersOptions($full=false)
	{ 
		//lists all officers 
		$_criteria = new CDbCriteria;
		$_criteria->order = 'level';
		// If full==false then except that officer which is attached to current user
		$full ? null : $_criteria->compare('id', "<>" . $this->getOfficerID());
		$_Officers = Officers::model()->findAll($_criteria);
	  	$officersArray = CHtml::listData($_Officers, 'id', 'title');
	  	return $officersArray;
	}

	/**
	 * @return array of valid Office Names
	 */ 
	public function getOfficeOptions()
	{ 
		//lists all offices 
//		$_criteria = new CDbCriteria;
		// If full==false then except that officer which is attached to current user
//		$full ? null : $_criteria->compare('id', "<>" . $this->getOfficerID());
		$_Offices = Office::model()->findAll();
	  	$officesArray = CHtml::listData($_Offices, 'id', 'station', 'name');
	  	return $officesArray;	
    }
    
	/**
	 * get the Officer ID attached with current user
	 */	
	public static function getOfficerID()
	{
		//find the current logged in user in the tbl_users table
		$_user = Users::model()->findByPk(Yii::app()->user->id);
		return (int) $_user->officer_id;
	}

	/**
	 * get the Officer's Level attached with current user
	 */	
	public function getOfficerLevel()
	{
		//find the current logged in user in the tbl_users table
		$_officer = Officers::model()->findByPk($this->getOfficerID());
		return $_officer->level;
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($_username, $_passwd)
	{
		$this->_identity=new UserIdentity($_username,$_passwd);
		if($this->_identity->authenticate())
		{
			return true;
		} else {
			$this->addError('passwd', 'Invalid password');
			return false;
		}
	}
    
	/**
	 * perform one-way encryption on the password before we store it in	the database
	 */
	protected function afterValidate()
	{
		parent::afterValidate();
		$this->password = $this->encrypt($this->password);
	}
	
	public function encrypt($value)
	{
		return md5($value);
	}
}
