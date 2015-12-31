<?php
class MemberPage extends Page
{
}

class MemberPage_Controller extends Page_Controller
{

    public static $allowed_actions = array('index');
    
    public function index()
    {
        $Member = Member::CurrentUser();
        if ($Member==null) {
            //echo "do resgistration";
            if ($RegistrationPage = DataObject::get_one('RegistrationPage')) {
                return $this->redirect($RegistrationPage->Link());
            }
        } else {
            //echo "do edit registration";
            if ($EditProfilePage = DataObject::get_one('EditProfilePage')) {
                return $this->redirect($EditProfilePage->Link());
            }
        }
    }
}
