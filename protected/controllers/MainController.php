<?php

class MainController
{
    static function init()
    {
        $menu    = Loader::view("menu.php");
        $footer  = Loader::view("footer.php");
        $main  = Loader::model("main.php", "", "");
        
        Template::set('main.php');
        Template::bind('menu', $menu[Multilang::$lang]);
        Template::bind('footer', $footer);
        Template::bind('doc', $main['doc'][Multilang::$lang]);
        
        Template::generate();
    }

    static function profile()
    {
        $menu    = Loader::view("menu.php"); //Get html part
        $footer  = Loader::view("footer.php"); //Get another html part
        $doc     = Loader::model("profile.php", "", ""); //Get data
 
        Template::set('subpage.php'); //Set template's name
        Template::bind('menu',  $menu[Multilang::$lang]); //bind the returned data to the tag name.
        Template::bind('footer', $footer);
        Template::bind('doc', $doc['doc'][Multilang::$lang]);
        
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
        Template::bind('menu',  $menu[Multilang::$lang]);
        Template::bind('footer', $footer);
    
        Template::generate();
    }

    static function contact()
    {
        $menu     = Loader::view("menu.php");
        $footer   = Loader::view("footer.php");
        $contact = Loader::model("contact.php", "", "");
        
        Template::set('subpage.php');
        Template::bind('menu',  $menu[Multilang::$lang]);
        Template::bind('footer', $footer);
        Template::bind('doc', $contact['doc'][Multilang::$lang]);
        
        Template::generate();
    }
    
}

?>