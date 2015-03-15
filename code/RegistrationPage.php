<?php 

class RegistrationPage extends Page 
{

}

class RegistrationPage_Controller extends Page_Controller 
{
	//Allow our form as an action
	static $allowed_actions = array(
		'RegistrationForm'
	);
	
	//Generate the registration form
	function RegistrationForm()
	{
	    $Member=Member::currentUser();

	    if ($Member!=null){
	    	//Get profile page
			if($ProfilePage = DataObject::get_one('EditProfilePage'))
			{
				//echo "profile page exists";
				//Redirect to profile page with success message
				return $this->redirect($ProfilePage->Link('?success=1'));			
			}

	    }
	    else{
	    	$fields = new FieldList(
		    	//new DropDownField('Group','<span>*</span>  Group', array('Employers' => 'Employers','Employees'=>'Employees' )),
				new TextField('FirstName', '<span>*</span> Firstname'),
				new TextField('Surname', '<span>*</span> Surname'),
				new EmailField('Email', '<span>*</span> Email'),
				new ConfirmedPasswordField('Password', '<span>*</span> Password')
			);

		 	
		    // Create action
		    $actions = new FieldList(
				new FormAction('doRegister', 'Register')
		    );
			// Create action
			$validator = new RequiredFields('Email');

		 	return new Form($this, 'RegistrationForm', $fields, $actions, $validator);		

	    }

	    
	}
	
	//Submit the registration form
	function doRegister($data,Form $form)
	{
		//Check for existing member email address
		if($member = DataObject::get_one("Member", "`Email` = '". Convert::raw2sql($data['Email']) . "'")) 
		{

			//Set error message
			$form->sessionMessage($data['Email'].". Sorry, that email address already exists. Please choose another.", 'bad');
				
			//Return back to form
			return $this->redirectBack();
			//return Director::redirectBack();		
		}	
		else{
			//Otherwise create new member and log them in
			$Member = new Member();
			$form->saveInto($Member);			
			$Member->write();
			$Member->login();
			
			//Find or create the 'user' group
			if(!$userGroup = DataObject::get_one('Group', "Code = 'Employees'"))
			{
				$userGroup = new Group();
				$userGroup->Code = "Employees";
				$userGroup->Title = "Employees";
				$userGroup->Write();
				$userGroup->Members()->add($Member);
			}
			//Add member to user group
			$userGroup->Members()->add($Member);
			
			//Get profile page
			if($ProfilePage = DataObject::get_one('EditProfilePage'))
			{
				//echo "profile page exists";
				//Redirect to profile page with success message
				return $this->redirect($ProfilePage->Link('?success=1'));			
			}
			
		}
		

		

	}
}