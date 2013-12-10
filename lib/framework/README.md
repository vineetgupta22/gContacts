gContacts - Directory lib/framework
=========

This Directory Contains the Library/framework files used in both
Developers and Demo.

Constants used:
----

1. ds
  
  ds used to dynamically get the DIRECTORY_SEPARATOR. If user is using on
  Windows then it will be "\" and if on linux or other types it would be 
  "/". It will according change it

2. time_zone

  If the framework is included through Developer version then option is given
  to set the time zone of developers choice. If the Developer want to use its
  own time zone then Developer must declare time_zone to true and provide
  time zone in variable $default_gContacts_timezone.
  
3. gContacts_lib, gContacts_template, gContacts_autoloader, gContacts_functions

  Defined as location to the library files. Given the option also to describe
  the location of own choice by user. If devloper is not including it then
  defaul location defination is use.
  
4. gautoloader
 
  The constant is used to check as to include gContacts autoloader into the 
  Framework or would be going to use the developers own autoloader class.
