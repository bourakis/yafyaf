<?php
/**
 * Sessions class file.
 * 
 * @author Melisides M. Costas <dsphinx@plug.gr>
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
 * Session class. Global vars management
 *
 * 
**/



class Sessions
{
    private $start;
    
    
    public function init()
    {

    }
    
    
    public function destroy()
    {
        $_SESSION = array();   // Destroy the variables.

        if($_SESSION) //If it doesn't do the check then web get an error 
            session_destroy();     // Destroy the session itself.
    }
    
    
    public function set($var,$value)
    {       
        $_SESSION[$var] = $value;
    }
    
    
    public function get($var)
    {
        if (isset($_SESSION[$var]))
           return ($_SESSION[$var]);
    }
    
    
    public function del($var)
    {
        unset ($_SESSION[$var]);
    }
    
    
    public function dump()
    {
        foreach ($_SESSION as $key => $value) 
            echo "$key = $value <br>";
    }
    
}