<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

		/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow authenticated users to perform 'index' action
				'actions'=>array('index'),
				'users'=>array('@'),
			),
			array('deny',	// deny all users to perform 'index' action
				'actions'=>array('index'),
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		
		//$MarkedModel=Marked::model()->findByAttributes(array('officer_id'=>Yii::app()->user->id));
//		$DocumentsModel=Documents::model()->with(array(
//			'markeds'=>array('condition'=>'officer_id='.Users::model()->getOfficerID())
//		))->findAll();
//						->select('*')
//						->from('tbl_documents')
//						->join('tbl_marked', 'tbl_documents.id=tbl_marked.document_id')
//						->where('tbl_marked.officer_id=:oid', array(':oid'=>Yii::app()->user->id))
//						->queryAll();
//		$_sql = "SELECT * 
//				FROM `tbl_documents`
//				JOIN `tbl_marked` ON `tbl_documents`.`id`=`tbl_marked`.`document_id`
//				WHERE `tbl_marked`.`officer_id`=:officerID";
//		$params = array(':officerID'=>Users::model()->getOfficerID());
//						
//		$dataProvider = Documents::model()->findAllBySql($_sql, $params);
		
		$dp = $this->buildArray();
		
		if(!empty($dp))
		{		
			$dataProvider = new CArrayDataProvider($dp, array(
	      			'pagination'=>array(
	        			'pageSize'=>50,
	      				),
	    			));
		} else {
			$dataProvider = new CArrayDataProvider(array());
		}

//		print_r($dataProvider);
		//$criteria=new CDbCriteria;
		//$criteria->condition='markeds.officer_id=:officerID';
		//$criteria->params=array('officerID'=>Yii::app()->user->id);
		//$dataProvider=Documents::model()->findAll($criteria); // $params is not needed
		//$dataProvider=new CActiveDataProvider('Documents');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));

//		$this->buildArray();
	}

	/*
	 * Builds array of documents to be marked by the current officer 
	 * @return array
	 */
	protected function buildArray()
	{
		$_report = array();
		$_user = Users::model()->findByPk(Yii::app()->user->id);
		//lists all documents marked to the current officer
		$_all_documents = "SELECT `tbl_documents`.`id`, `diary_number`, `date_received`, `reference_number`, `date_of_document`, `received_from`, `description`, `tbl_marked`.`marked_by` 
							FROM `tbl_documents`
							INNER JOIN (`tbl_marked` 
								LEFT JOIN `tbl_disposal` ON `tbl_marked`.`document_id`=`tbl_disposal`.`document_id`)
								ON `tbl_documents`.`id`=`tbl_marked`.`document_id` 
							WHERE `tbl_disposal`.`document_id` IS NULL
								AND `tbl_marked`.`officer_id`=" . $_user->getOfficerID() . "
							ORDER BY `tbl_documents`.`id`";
		
		$_all_documents = Yii::app()->db->createCommand($_all_documents)->queryAll();
		
		if (!$_all_documents) return array();
		
		$i=0;
		foreach ($_all_documents as $_document)
		{
			// Checks if the current document is already marked by this officer
			if ($this->checkLastMarking($_document['id'], $_user->getOfficerID()))
			{
				//if not then assign the values to the returning array
				$_report[$i]['id'] 				= $_document['id'];
				$_report[$i]['diary_number'] 	= $_document['diary_number'];
				$_report[$i]['date_received'] 	= $this->formatDate($_document['date_received']);
				$_report[$i]['reference_number']= $_document['reference_number'];
				$_report[$i]['date_of_document']= $this->formatDate($_document['date_of_document']);
				$_report[$i]['received_from'] 	= $_document['received_from'];
				$_report[$i]['description'] 	= $_document['description'];
				$_report[$i]['marked_by']		= Officers::model()->findByPk($_document['marked_by'])->title;
				$_report[$i]['actions'] 		= CHtml::link('Mark', Yii::app()->createUrl('marked/create', array('docid'=>$_document['id']))) . ' | '.
												  CHtml::link('Dispose', Yii::app()->createUrl('disposal/create', array('docid'=>$_document['id']))) . ' | ' .
												  CHtml::link('View', Yii::app()->createUrl('documents/view', array('id'=>$_document['id'])));
				$i++;
			}	
		}
		return $_report;
	}

	/*
	 * This function checks that if the given document is already marked by this officer
	 * @param integer document_id: document to look for
	 * @param integer marked_by: the id officer who marked it
	 */
	public function checkLastMarking($document_id, $officerID)
	{
		$sql = "SELECT officer_id FROM tbl_marked WHERE document_id=:documentID";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(":documentID", $document_id, PDO::PARAM_INT);
		//$command->bindValue(":markedBy", $marked_by, PDO::PARAM_INT);
		$result = $command->queryAll();
		$sizeOfResult = count($result);
		return ($result[$sizeOfResult-1]['officer_id'] == $officerID) ? true : false;
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	/**
	 * 
	 * Formats the date to dd-mm-yyyy
	 * @param string $date
	 * @return string
	 */
	protected function formatDate($date)
	{
		list($y, $m, $d) = explode('-', $date);
        $mk=mktime(0, 0, 0, $m, $d, $y);
        return date('d-m-Y', $mk);
	}
}