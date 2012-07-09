<?php

class MainController
{
    static function init()
    {
        $menu    = Loader::view("menu.php");
        $footer  = Loader::view("footer.php");
        
        Template::set('main.php');
        Template::bind('menu', $menu);
        Template::bind('footer', $footer);
        
        Template::generate();
    }

    static function profile()
    {
        $menu    = Loader::view("menu.php"); //Get html part
        $footer  = Loader::view("footer.php"); //Get another html part
        $doc     = Loader::model("profile.php", "", ""); //Get data
 
        Template::set('subpage.php'); //Set template's name
        Template::bind('menu', $menu); //bind the returned data to the tag name.
        Template::bind('footer', $footer);
        Template::bind('doc', $doc['doc'][Multilang::$lang]);
        
        Template::generate(); //Generate the web page.
    }

    static function stuff()
    {
        $data    = Loader::model("MainModel", "query1", "");                        
        $doc     = Loader::view("list.php", $data);
        $menu    = Loader::view("menu.php");
        $footer  = Loader::view("footer.php");

        Template::set('subpage.php');
        Template::bind('doc', $doc);
        Template::bind('menu', $menu);
        Template::bind('footer', $footer);
    
        Template::generate();
    }

    static function contact()
    {
        $menu    = Loader::view("menu.php");
        $footer  = Loader::view("footer.php");
        $doc     = Loader::model("contact.php", "", "");
        
        Template::set('subpage.php');
        Template::bind('menu', $menu);
        Template::bind('footer', $footer);
        Template::bind('doc', $doc);
        
        Template::generate();
    }
    
}

?>