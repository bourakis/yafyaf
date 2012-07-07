<?php 
/**
 * YafCore class file.
 * 
 * @author Andreas Bourakis <bourakis@gmail.com>
 * @contributors Konstantinos Apazidis (konapaz@gmail.com)
 * @copyright omicro.net
 * @link http://www.github.com/addboo/yaf
 * @license http://www.opensource.org/licenses/mit-license.php
 * @requires
 *
 * @version: 0.1
**/

/** 
 * DESCRIPTION:
 * This is a Core of the application which manage the loaded data,
 * the templates and the modules. 
 * 
**/



// Libraries Load
require(dirname(__FILE__).'/Db.php'); 
require(dirname(__FILE__).'/Template.php'); 
require(dirname(__FILE__).'/Loader.php'); 


class YafCore 
{
    public static $controller_name;
    public static $controller_file;
    public static $cfg = array();
    public static $action;
    public static $params = array();


    
    function run($cfg)
    {
        self::$cfg = $cfg;
        
        Db::connect(self::$cfg['db']['host'], self::$cfg['db']['uname'],
                    self::$cfg['db']['pass'], self::$cfg['db']['db_name']);

            Loader::run(); //Run the Libs and Modules defined in config file.
    
             if (!self::controller_loader()) {
                 die("No controller found!");
             }

            if (!self::action_loader()) {
                die("No action found!");
            }

            self::params_loader();
        
        Db::close();
    }
    

    
    function controller_loader()
    {
        if(isset($_GET['c'])) //$_GET['c'] is for controller
        {

            if(file_exists("protected/controllers/".$_GET['c'].".php"))
            {    
                require_once("protected/controllers/".$_GET['c'].".php"); //THIS IS A SIGNIFICANT SECURITY BUG!!!!

                self::$controller_name = $_GET['c'];
                self::$controller_file = self::$controller_name.".php";
                return true;
            } else
            {
                return false;
            }

        }
        elseif(isset($_POST['c']))
        {

            if(file_exists("protected/controllers/".$_POST['c'].".php"))
            {    
                require_once("protected/controllers/".$_POST['c'].".php"); //THIS IS A SIGNIFICANT SECURITY BUG!!!!

                self::$controller_name = $_POST['c'];
                self::$controller_file = self::$controller_name.".php";
                return true;
            } else
            {
                return false;
            }

        }
        else
        {
            // Load the default controller
            self::$controller_name = self::$cfg['default_controller'];
            self::$controller_file = self::$controller_name.".php";
            
            require_once("protected/controllers/".self::$controller_file);
            return true;
        }        
    }



    function action_loader()
    {
        if (isset($_GET['a'])) self::$action = $_GET['a'];
            elseif (isset($_POST['a'])) self::$action = $_POST['a'];
                else self::$action = 'init';
        
        if (!method_exists(self::$controller_name,self::$action)) return false;
      
        call_user_func(array(self::$controller_name, self::$action));
        
		return true;
    }



    function params_loader()
    {   
        $params = array();

        if(isset($_GET['p']))
        {
            $params = $_GET['p'];
                
            while(list($key, $val) = @each($params))
            {   //securing
                if (PureValidator::isCastAlphaNum($val)) self::$params[] = $val;
            }
            
        }
        elseif(isset($_POST['p']))
        {
            $params = $_POST['p'];
                    
            while(list($key, $val) = @each($params))
            {
                if (PureValidator::isCastAlphaNum($val)) self::$params[] = $val;
            }
            
        }        
    }
        
}

?>