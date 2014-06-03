<?php

class DocumentsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $defaultAction='admin';

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
			array('allow',  // allow authenticated users to perform 'index', 'view', 'create', 'update' and 'admin' actions
				'actions'=>array('index','view', 'create', 'update', 'admin'),
				'users'=>array('@'),
			),
			array('allow', // allow dadmin user to perform 'delete' actions
				'actions'=>array('delete'),
				'users'=>array('admin', 'ico'),
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
		// Query the rows from tbl_marked relating to this document
		$markedDataProvider=new CActiveDataProvider('Marked', array(
      		'criteria'=>array(
        		'condition'=>'document_id=:documentId',
        		'params'=>array(':documentId'=>$this->loadModel($id)->id),
      		),
      		'pagination'=>array(
        		'pageSize'=>10,
      		),
    	));
    	
    	// Query the rows from tbl_disposal relating to this document
    	$disposalDataProvider=new CActiveDataProvider('Disposal', array(
      		'criteria'=>array(
        		'condition'=>'document_id=:documentId',
        		'params'=>array(':documentId'=>$this->loadModel($id)->id),
      		),
      		'pagination'=>array(
        		'pageSize'=>10,
      		),
    	));
    	
		// render the view
    	$this->render('view',array(
			'model'=>$this->loadModel($id),
    		'markedDataProvider' => $markedDataProvider,
    		'disposalDataProvider' => $disposalDataProvider,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'marked/create' page.
	 */
	public function actionCreate()
	{
		$model=new Documents;
		
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documents']))
		{
			$model->attributes=$_POST['Documents'];
			
			$uploadedFiles=CUploadedFile::getInstancesByName('images');
			
			if($model->save())
			{
				if (isset($uploadedFiles) && count($uploadedFiles) > 0)
				{
					foreach ($uploadedFiles as $upfile=>$image)
					{
						$img = Yii::app()->image->load($image->getTempName());
						if ($img->width > 900) 
						{
							$img->resize(900, 500, Image::WIDTH);
						}
						$img->gamma_correction(1.0, 0.50); //My addition to the extension
						$img->sharpen(50);

						$filename = $model->id . '-' . $model->diary_number . '['. $upfile . '].' . $image->getExtensionName(); 
						if ($img->save(Yii::app()->basePath.'/../document_images/'.$filename))
						{
							$image_model = new DocumentImages;
							$image_model->setIsNewRecord(true);
							$image_model->document_id = $model->id;
							$image_model->image_path = $filename;
							$image_model->save();
						}
					}
				}
				$this->redirect(array('/marked/create','docid'=>$model->id));
			}
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

		if(isset($_POST['Documents']))
		{
			$model->attributes=$_POST['Documents'];
			if($model->save())
			{
				$uploadedFiles=CUploadedFile::getInstancesByName('images');
				if (isset($uploadedFiles) && count($uploadedFiles) > 0)
				{
					foreach ($uploadedFiles as $upfile=>$image)
					{
						$img = Yii::app()->image->load($image->getTempName());
						if ($img->width > 900) 
						{
							$img->resize(900, 500, Image::WIDTH);
						}
						
						$img->gamma_correction(1.0, 0.50); //My addition to the extension
						$img->sharpen(50);
						
						$idx = $this->nextIndexForFile($model->id);
						$filename = $model->id . '-' . $model->diary_number . '['. $idx . '].' . $image->getExtensionName(); 
						if ($img->save(Yii::app()->basePath.'/../document_images/'.$filename))
						{
							$image_model = new DocumentImages;
							$image_model->setIsNewRecord(true);
							$image_model->document_id = $model->id;
							$image_model->image_path = $filename;
							$image_model->save();
							unset($image_model);
						}
						unset($uploadedFiles);
					}
				}
				
				$images = $model->images;
				if (!empty($images))
				{
					foreach ($images as $idx=>$image)
					{
						$elementName = $image['id'] .'-'. $image['document_id'] .'-'. $idx;
						if (isset($_POST[$elementName]) && $_POST[$elementName]=="delete")
						{
							$image_model = DocumentImages::model()->findByPk($image['id']);
							if (unlink(Yii::app()->basePath.'/../document_images/'.$image['image_path']))
								$image_model->delete();
							
						}
					}
				}
				$this->redirect(array('view','id'=>$model->id));
			}
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
		$this->actionAdmin();
//		$dataProvider=new CActiveDataProvider('Documents');
//		$this->render('index',array(
//			'dataProvider'=>$dataProvider,
//		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Documents('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Documents']))
			$model->attributes=$_GET['Documents'];


		$this->render('admin',array(
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
		$model=Documents::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='documents-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * 
	 * returns next index for the file to be saved
	 * @param integer $documentID to look for in the database
	 * @return integer next index for file
	 */
	protected function nextIndexForFile($documentID)
	{
		$doc_images = DocumentImages::model()->findAllByAttributes(array('document_id'=>$documentID));
		$i = 0;
		foreach($doc_images as $img)
		{
			$_o_position = strpos($img['image_path'], '[');
			$_c_position = strpos($img['image_path'], ']');
			$num = substr($img['image_path'], $_o_position+1, $_c_position - $_o_position - 1);
			if ($i<$num) $i = $num;
		}
		return ++$i;
	}
}
