<?php
/**
 * yaf Framework :: sys :: mod :: Auth.php 
 * @version: 1.0 - (22/01/2012)
 * @requires: Session
 * @author Andreas Bourakis (bourakis@gmail.com)
 * @Description: Authentication methods
 
 * Licensed under MIT licence:
 *   http://www.opensource.org/licenses/mit-license.php
 
 *  TODO: Password transformation to MD5
 *
**/


class Auth 
{
    public static $username;
    public static $password;


    // init() is called automatically when a Module is loaded.
    function init() 
    {
        
        if(isset($_GET['logout']) || isset($_POST['logout']))
        {
            Auth::logout();
        }
        
    }
    
    
    // This is executed when a user disables the module. Here you can put code
    // for cleaning up changes that was done on the environment.
    function onDisable()
    {
        
    }
    

    function login($username, $password)
    {
        self::$username = $username;
        self::$password = $password;
            

        $user_id = self::isRegistered($username, $password);
        
        if($user_id)
        {
            Sessions::set('uid', $user_id);
            //Common::redirect('index.php?m=admin&v=admin');
            
            $ret = 1;
        }
        else
        {
            $ret = 0;
        }
        
        return $ret;
    }
    
    
    function logout()
    {
        Sessions::destroy();
    }


    function isLoggedIn()
    {
        if(isset($_SESSION[uid]))
            $ret = 1;
        else
            $ret = 0;
        
        return $ret;
    }
    
    
    function loadHtml($path_filename)
    {        
        $data = file($path_filename);
        foreach($data as $value)
        {
            $html .= "$value";
        }
        
        return $html;
    }
    


     // MySql functions.
    ////////////////////
    
    function isRegistered($username, $password)
    {
        $result = mysql_query("SELECT id
                               FROM Accounts
                               WHERE username='$username' AND password='$password' ");
        
        $row = mysql_fetch_array($result);
        
        return $row['id'];
    }


    function getUsername()
    {
        if(isset($_SESSION[uid]))
        {
            $result = mysql_query("SELECT username
                                   FROM Accounts
                                   WHERE id=$_SESSION[uid]");
            
            $row = mysql_fetch_array($result);
            
            return $row['username'];
        }
    }


    function getEmail()
    {
        if(isset($_SESSION[uid]))
        {
            $result = mysql_query("SELECT email
                                   FROM Accounts
                                   WHERE id=$_SESSION[uid]");
            
            $row = mysql_fetch_array($result);
            
            return $row['email'];
        }
    }


    function getFnameLname()
    {
        if(isset($_SESSION[uid]))
        {
            $result = mysql_query("SELECT fname, lname
                                   FROM Accounts
                                   WHERE id=$_SESSION[uid]");
            
            $row = mysql_fetch_array($result);
            
            return $row['fname'].",".$row['lname'];
        }
    }

}

?>