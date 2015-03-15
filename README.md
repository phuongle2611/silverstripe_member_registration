SilverStripe Simple Member Registration Module
========================================

Maintainer Contacts
-------------------
*  Phuong Le (<phuongle2611@hotmail.com>)

Requirements
------------

* SilverStripe 3.1 - [master branch](https://github.com/phuongle2611/silverstripe_member_registration)

Installation Instructions
-------------------------

1. Place this directory in the root of your SilverStripe installation.
2. Visit yoursite.com/dev/build to rebuild the database.

Usage Overview
--------------

IN CMS under sitetree, create a page with page type "Member Page" and tick to show under Menu. Create 2 more invisible page under "Member Page" with page type "Registration Page" and "Edit Profile Page".

"Member Page" type is a wrapper of "Registratrion Page" and "Edit Profile Page". When user navigate to "Member Page", it will redirect to "registration page" for new user or to "Edit Profile Page" for logged in user to edit his profile.

After new user register to the website, website will redirect user to "Edit Profile Page".

Developer also can extend data of the member class in MemberDecoderator.php.


Known Issues
------------
[Issue Tracker](http://github.com/phuongle2611/silverstripe_member_registration/issues)
  
