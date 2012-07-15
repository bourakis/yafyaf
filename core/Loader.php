<?php
/**
 * Loader class file.
 * 
 * @author Andreas Bourakis <bourakis@gmail.com>
 * @contributors Konstantinos Apazidis (konapaz@gmail.com)
 * @copyright omicro.net
 * @link http://www.github.com/addboo/yafyaf
 * @license http://www.opensource.org/licenses/mit-license.php
 * @requires
 *
 * @version: 0.1
**/

/** 
 * DESCRIPTION:
 * Framework's Loader Manager of Libs and Modules.
 *
 * 
**/

/** 
 *  TODO: Running modules on demand. In order to do that we have to redeclare
 *        the run() method to run($module_name). So, when a $module_name is set
 *        load the module, else load all the modules declared in config.php file.
 *
**/


class Loader
{
    public static $modules_stack = array();
    public static $libs_stack = array();


    // Then run the modules from the stack
    static function run()
    {
        // Modules Part
        $x = 0;
        while(isset(YafCore::$cfg['modules'][$x])) //Load all Modules
        {  
            self::module_load(YafCore::$cfg['modules'][$x]);
            $x++;
        }
        
        $x=0;
        while(isset(self::$modules_stack[$x])) // Run each Module/Class.
        {
            //call init() function from each module.
            call_user_func(array(self::$modules_stack[$x], 'init')); 
            $x++;
        }



        // Libs Part
        $x = 0;
        while(isset(YafCore::$cfg['libs'][$x])) //Load all Libs
        {
            self::lib_load(YafCore::$cfg['libs'][$x]);
            $x++;
        }
        
        $x=0;
        while(isset(self::$libs_stack[$x])) // Run each Lib/Class.
        {
            //call init() function from each lib.
            call_user_func(array(self::$libs_stack[$x], 'init')); 
            $x++;
        }
        
    }
    
    
    // Module loader to the stack array.
    static function module_load($module_name)
    {
        if(include_once($_SESSION['BASE_PATH'].'/modules/'.$module_name.'/'.$module_name.'.php'))
        {    
            self::$modules_stack[] = $module_name;
            
            return new $module_name;
        }
        else
        {
            throw new Exception('Module not found!');
        }
    }


    // Lib loader to the stack array.
    static function lib_load($lib_name)
    {
        if(include_once($_SESSION['BASE_PATH'].'/core/'.$lib_name.'.php'))
        {    
            self::$libs_stack[] = $lib_name;
            
            return new $lib_name;
        }
        else
        {
            throw new Exception('Lib not found!');
        }
    }


    static function model($model_filename, $function, $params)
    {
        // Checks if the given filename in $model_filename contains
        // the .php extension.If exists, then remove it!
        if($res = stripos($model_filename, ".php"))
        {
            $model_filename = str_replace(".php", "", $model_filename);
        }


        $filename = $model_filename.".".Multilang::$lang.".php";


        // Check if the file isn't in multi-language format like content.en.php
        // but it's content.php instead.
        if(!file_exists("protected/models/".$filename))
        {
            $filename = $model_filename.".php";
        }


        // if $function is empty then load the data from a file
        // containing the data in array.
        if($function == "" )
        {
            return require_once 'protected/models/'.$filename;
        }
        // load data from the class, calling function and/or declaring
        // parameters.
        else
        {
            require_once 'protected/models/'.$filename;
            return call_user_func(array($model_filename, $function), $params);
        }
    }
    
    
    static function view($view_filename, $data = null)
    {
        /*
        if(is_array($data))
        {
            extract($data);
        }
        */

        // Checks if the given filename in $model_filename contains
        // the .php extension.If exists, then remove it!
        if($res = stripos($view_filename, ".php"))
        {
            $view_filename = str_replace(".php", "", $view_filename);
        }

        $filename = $view_filename.".".Multilang::$lang.".php";

        // Check if the file isn't in multi-language format like content.en.php
        // but it's content.php instead.
        if(!file_exists("protected/views/".$filename))
        {
            $filename = $view_filename.".php";
        }

        return require_once 'protected/views/'.$filename;
    }


    static function widget($widget_name, $function, $params)
    {
        require_once 'protected/widgets/'.$widget_name.'/'.$widget_name.'.php';
        $function($params);
    }
}

?>