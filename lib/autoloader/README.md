gContacts - Directory lib/autoloader
=========

This Directory Contains the Library/autoloader files used in 
both Developers and Demo

Variable Information
----
Information about variable used in the Class and there purpose


1. imported

  It will store all the locations of the classes. 


        $_imported = array();

        //Each array will be storing as:
        class_name => location of the file

 
 
2. Classes

  It will store all the classes which are loaded dynamically in the Project. 
So, that we don't need to again and again include the same class


        $_classes = array();
        
        //Each array will be storing as:
        class_name => ture/false;


3. Extension

  Extension of the file which is used for importing the class.
  

        $ext = ".php";


4. File Name prefix

  Before importing the file we must add the prefix which completes the name of file.
  
  
        $prefix = "gContacts_"