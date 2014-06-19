<?php
/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identify the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	private $_officer_id;
    private $_office_id;
    
	/**
	 * Authenticates a user using the Users data model.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user=Users::model()->findByAttributes(array('username'=>$this->username));
		if($user===null)
		{
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else
		{
			if($user->password!==$user->encrypt($this->password))
			{
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
			}
			else
			{
				$this->_id = $user->id;
				//$this->_officer_id = $user->officer_id;
				/*if(null===$user->last_login_time)
				{
					$lastLogin = time();
				}
				else
				{
					$lastLogin = strtotime($user->last_login_time);
				}*/
				$this->setState('officerID', $user->officer_id);
//                $this->setState('officeID', $user->office_id);
				$this->errorCode=self::ERROR_NONE;
			}
		}
		return !$this->errorCode;
	}
	
	public function getId()
	{
		return $this->_id;
	}
	
	public function getOfficerID()
	{
		return $this->_officer_id;
	}

	public function getOfficeID()
	{
		return $this->_office_id;
	}    
}