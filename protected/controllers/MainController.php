<?php

class MainController
{
    static function init()
    {
        $menu    = Loader::view("menu.php");  //Get html part
        $footer  = Loader::view("footer.php");  //Get html part

        $main_content = Loader::model("main.php", "", "");  // Get data
        $main_content = Loader::view("main_content.php", $main_content);  // Pass the data to
                                                                          // the View (visualization)
        Template::set('main.php');  // Set template's name
        Template::bind('menu', $menu);  // Binding the $menu contents to template with tag name "menu"
        Template::bind('footer', $footer);  // Binding the $footer contents to template with tag name "footer"
        Template::bind('doc', $main_content);
        
        Template::generate();  // Generate the web page.
    }

    static function profile()
    {
        $menu    = Loader::view("menu.php"); //Get html part
        $footer  = Loader::view("footer.php"); //Get another html part

        $doc     = Loader::model("profile.php", "", ""); //Get data
        $doc     = Loader::view("profile.php", $doc);

        Template::set('subpage.php'); //Set template's name
        Template::bind('menu',  $menu); //bind the returned data to the tag name.
        Template::bind('footer', $footer);
        Template::bind('doc', $doc);
        
        Template::generate(); //Generate the web page.
    }

    static function stuff()
    {
        $data    = Loader::model("MainModel", "query1", ""); //Get data from DB using query1.                       
        $list    = Loader::view("list.php", $data); // Pass the $data to the view
        $menu    = Loader::view("menu.php"); 
        $footer  = Loader::view("footer.php");

        Template::set('subpage.php'); //Set the template to be used.
        Template::bind('doc', $list); 
        Template::bind('menu',  $menu);
        Template::bind('footer', $footer);
    
        Template::generate();
    }

    static function contact()
    {
        $menu     = Loader::view("menu.php");
        $footer   = Loader::view("footer.php");
        $contact  = Loader::model("contact.php", "", "");
        $contact1 = Loader::view("contact.php", $contact);

        Template::set('subpage.php');
        Template::bind('menu',  $menu);
        Template::bind('footer', $footer);
        Template::bind('doc', $contact1);
        
        Template::generate();
    }
    
}

?>