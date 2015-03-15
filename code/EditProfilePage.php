<?php 

class EditProfilePage extends Page 
{
}

class EditProfilePage_Controller extends Page_Controller 
{
	static $allowed_actions = array(
		'EditProfileForm'
	);

	function EditProfileForm()
	{
		//Create our fields
	    $fields = new FieldList(
			new TextField('FirstName', '<span>*</span> Firstname'),
			new TextField('Surname', '<span>*</span> Surname'),
			new EmailField('Email', '<span>*</span> Email'),
			new TextField('JobTitle', 'Job Title'),
			new TextField('Website', 'Website (Without http://)'),
			new TextareaField('Blurb'),
			new ConfirmedPasswordField('Password', 'New Password')
		);
	 	
	    // Create action
	    $actions = new FieldList(
			new FormAction('SaveProfile', 'Save')
	    );
		
		// Create action
		$validator = new RequiredFields('FirstName', 'Email');
	   
	   //Create form
		$Form = new Form($this, 'EditProfileForm', $fields, $actions, $validator);

		//Populate the form with the current members data
		$Member = Member::CurrentUser();
		$Form->loadDataFrom($Member->data());
		
		//Return the form
		return $Form;
	}
	
	//Save profile
	function SaveProfile($data, $form)
	{
		//Check for a logged in member
		if($CurrentMember = Member::CurrentMember())
		{
			//Check for another member with the same email address
			if($member = DataObject::get_one("Member", "Email = '". Convert::raw2sql($data['Email']) . "' AND ID != " . $CurrentMember->ID)) 
			{
				//Set error message
				$form->sessionMessage($data['Email'].". Sorry, that email address already exists. Please choose another.", 'bad');
				
				//Return back to form
				return $this->redirectBack();
				//return Director::redirectBack();	
			}
			//Otherwise check that user IDs match and save
			else
			{
				$form->saveInto($CurrentMember);	
				
				$CurrentMember->write();

				return $this->redirect($this->Link('?saved=1'));								
			}
		}
		//If not logged in then return a permission error
		else
		{
			return Security::PermissionFailure($this->controller, 'You must <a href="register">registered</a> and logged in to edit your profile:');
		}
	}	
	
	//Check for just saved
	function Saved()
	{
		return $this->request->getVar('saved');
	}
	
	//Check for success status
	function Success()
	{
		return $this->request->getVar('success');
	}		
	
}