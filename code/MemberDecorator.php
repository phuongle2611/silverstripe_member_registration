<?php
class MemberDecorator extends DataExtension
{

    private static $db=array(
                "JobTitle" => 'Varchar',
                "Blurb" => "Text",
                "Website" => "Varchar(100)"
            );
    
    //Add form fields to CMS
    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab("Root.Profile", new TextField('JobTitle', 'Job Title'));
        $fields->addFieldToTab("Root.Profile", new TextField('Website', 'Website', 'http://'));
        $fields->addFieldToTab("Root.Profile", new TextareaField('Blurb', 'Blurb'));
    }
    
    //Link to the edit profile page
    public function Link()
    {
        if ($ProfilePage = DataObject::get_one('EditProfilePage')) {
            return $ProfilePage->Link();
        }
    }
}
