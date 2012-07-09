<?php
/**
 * Template class file.
 * 
 * @author Andreas Bourakis <bourakis@gmail.com>
 * @contributors
 * @copyright omicro.net
 * @link http://www.github.com/addboo/yafyaf
 * @license http://www.opensource.org/licenses/mit-license.php
 * @requires
 *
 * @version: 0.1
**/

/** 
 * DESCRIPTION:
 * 
 *
 * 
**/


class Template
{
    public static $template;
    public static $tag = array();
    
    
    public $css_stack = array();
    public $js_stack = array();

    
    function set($template_name)
    {
        self::$template = $template_name;
    }
    
    
    function bind($tag_name, $data)
    {
        if(is_array($data))
        {
            foreach($data as $name => $val)
            {
                self::$tag[$name] = $val;
            }
        }
        else
        {
            self::$tag[$tag_name] = $data;
        }
    }
    
    function getData()
    {
        return self::$tag;
    }
    
    function generate()
    {        
        require_once "protected/templates/".self::$template;   
    }
    
    
    
    //
    // Below functions are for future development.
    //
    function load_css($css_file)
    {
        self::$css_stack[] = $css_file;
    }

    function load_js($js_file)
    {
        self::$js_stack[] = $js_file;
    }
}

?>