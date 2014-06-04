<?php

class UsersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
    private $_authManager;
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('admin'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('allow',
				'actions'=>array('changepwd'),
				'users'=>array('@')
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Users;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Users');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Changes the password of the current user
	 */
	public function actionChangepwd()
	{
		$model=$this->loadModel(Yii::app()->user->id);
		$model->scenario = 'changepwd';
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->authenticate($model->username, $model->password))
			{
				$model->password = $model->newpasswd;
				if($model->save())
				{
					Yii::app()->user->setFlash('PasswdChanged', 'Password changed successfully.');
					//$this->redirect(array('/'));
				}
			}
		}
		
		$this->render('changepwd',array(
			'model'=>$model,
		));
	}
    
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
    public function actionRunRbac($args)
    {
        //ensure that an authManager is defined as this is mandatory for creating an auth heirarchy
        if(($this->_authManager=Yii::app()->authManager)===null)
        {
            echo "Error: an authorization manager, named 'authManager' must be configured to use this command.\n";
            echo "If you already added 'authManager' component in application configuration,\n";
            echo "please quit and re-enter the yiic shell.\n";
            return;
        }  
        else
        {
			//provide the oportunity for the use to abort the request
	        echo "This command will create three roles: AG, AAG, DAG, AO and the following premissions:\n";
        	echo "create, read, update and delete user\n";
        	echo "create, read, update and delete documents\n";
        	echo "create, read, update and delete disposal\n";
       
			//first we need to remove all operations, roles, child relationship and assignments
             $this->_authManager->clearAll();
			//create the lowest level operations for users
             $this->_authManager->createOperation("createUser","create a new user"); 
             $this->_authManager->createOperation("readUser","read user profile information"); 
             $this->_authManager->createOperation("updateUser","update a users information"); 
             $this->_authManager->createOperation("deleteUser","remove a user from a project"); 
			//create the lowest level operations for projects
             $this->_authManager->createOperation("createProject","create a new project"); 
             $this->_authManager->createOperation("readProject","read project information"); 
              $this->_authManager->createOperation("updateProject","update project information"); 
             $this->_authManager->createOperation("deleteProject","delete a project"); 
			//create the lowest level operations for issues
             $this->_authManager->createOperation("createIssue","create a new issue"); 
             $this->_authManager->createOperation("readIssue","read issue information"); 
             $this->_authManager->createOperation("updateIssue","update issue information"); 
             $this->_authManager->createOperation("deleteIssue","delete an issue from a project");     
			//create the reader role and add the appropriate permissions as children to this role
             $role=$this->_authManager->createRole("reader"); 
             $role->addChild("readUser");
             $role->addChild("readProject"); 
             $role->addChild("readIssue"); 
			//create the member role, and add the appropriate permissions, as well as the reader role itself, as children
             $role=$this->_authManager->createRole("member"); 
             $role->addChild("reader"); 
             $role->addChild("createIssue"); 
             $role->addChild("updateIssue"); 
             $role->addChild("deleteIssue"); 
			//create the owner role, and add the appropriate permissions, as well as both the reader and member roles as children
             $role=$this->_authManager->createRole("owner"); 
             $role->addChild("reader"); 
             $role->addChild("member");    
             $role->addChild("createUser"); 
             $role->addChild("updateUser"); 
             $role->addChild("deleteUser");  
             $role->addChild("createProject"); 
             $role->addChild("updateProject"); 
             $role->addChild("deleteProject");    
        
             //provide a message indicating success
             echo "Authorization hierarchy successfully generated.";
        } 
    }
}
