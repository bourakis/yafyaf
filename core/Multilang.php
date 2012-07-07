<?php
/**
 * Multilang class file.
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
 * Framework's Multilanguage Class
 *
 * 
**/


class Multilang
{
    static $lang;
    static $lang_id;
    
    
    function init()
    {

        if (isset($_GET['lang']))  self::$lang=$_GET['lang'];
            elseif (isset($_POST['lang']))  self::$lang=$_POST['lang'];
               elseif(isset($_SESSION['lang'])) self::$lang=$_SESSION['lang'];
                 else
                 {
                      self::$lang = Yaf::$cfg['lang'][0];
                      $_SESSION['lang_id'] = self::$lang_id; //TODO ???
                 }

       

               
        //if the language is invalid or not exists, set the default
        if (!PureValidator::isCastAlphaNum(self::$lang) || !in_array(self::$lang,Yaf::$cfg['lang'])) self::$lang = Yaf::$cfg['lang'][0];
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

    //return the id of a given language name.    
    function getLangId($lang)
    {
        return Db::getLangId($lang);
    }

    //return the language name OR prefix for a given language ID.    
    function getLang($lang_id)
    {
        return Db::getLang($lang_id);
    }

    /*
    function loadTextLang($module)
    {
        $_SESSION[lang] = $lang;
        return $lang;
    }
    */
}

?>