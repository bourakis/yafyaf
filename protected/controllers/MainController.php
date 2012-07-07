<?php

class MainController
{
    static function init()
    {
        $menu    = Loader::html("protected/views/menu.php");
        $footer  = Loader::html("protected/views/footer.php");
        
        Template::set('main');
        Template::bind('menu', $menu);
        Template::bind('footer', $footer);
        
        Template::generate();
    }

    static function profile()
    {
        $menu    = Loader::html("protected/views/menu.php");
        $footer  = Loader::html("protected/views/footer.php");
        $doc     = Loader::model("profile.php", "", "");
 
        Template::set('subpage');
        Template::bind('menu', $menu);
        Template::bind('footer', $footer);
        Template::bind('doc', $doc['doc'][Multilang::$lang]);
        
        Template::generate();
    }

    static function stuff()
    {
        Template::set('subpage');

        $data    = Loader::model("MainModel", "query1", "");                        
        $doc     = Loader::view("list.php", $data);
        Template::bind('doc', $doc);
        

        $menu    = Loader::html("protected/views/menu.php");
        Template::bind('menu', $menu);

        $footer  = Loader::html("protected/views/footer.php");
        Template::bind('footer', $footer);
        
        Template::generate();
    }

    static function contact()
    {
        $menu    = Loader::html("protected/views/menu.php");
        $footer  = Loader::html("protected/views/footer.php");
        $doc     = Loader::model("contact.php", "", "");
        
        Template::set('subpage');
        Template::bind('menu', $menu);
        Template::bind('footer', $footer);
        Template::bind('doc', $doc);
        
        Template::generate();
    }
    
}

?>