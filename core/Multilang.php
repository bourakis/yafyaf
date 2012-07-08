<?php
/**
 * Multilang class file.
 * 
 * @author Andreas Bourakis <bourakis@gmail.com>
 * @contributors Konstantinos Apazidis <konapaz@gmail.com>
 * @copyright omicro.net
 * @link http://www.github.com/addboo/yafyaf
 * @license http://www.opensource.org/licenses/mit-license.php
 * @requires
 *
 * @version: 0.1
**/

/** 
 * DESCRIPTION:
 * Framework's Multilanguage Class
 *
 * 
**/


class Multilang
{
    static $lang;
    
    
    function init()
    {
        if (isset($_GET['lang']))
        {
            self::$lang=$_GET['lang'];
            $_SESSION['lang'] = self::$lang;
        }
        elseif (isset($_POST['lang']))
        {
            self::$lang=$_POST['lang'];
            $_SESSION['lang'] = self::$lang;
        }
        elseif(isset($_SESSION['lang']))
        {
            self::$lang=$_SESSION['lang'];
        }
        else
        {
            self::$lang = Yaf::$cfg['lang'][0];
            $_SESSION['lang'] = self::$lang;
        }

       
        //if the language is invalid or not exists, set the default
        if (!PureValidator::isCastAlphaNum(self::$lang) ||
            !in_array(self::$lang, Yaf::$cfg['lang']))
        {
                self::$lang = Yaf::$cfg['lang'][0];
        }
    }
    
    //set the language
    function set($lang)
    {
        $_SESSION[lang] = $lang;
    }

    //return the declared language
    function get()
    {
        return self::$lang;
    }

}

?>