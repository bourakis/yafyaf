<?php
/**
 * Yaf Framework 
 * @version: 2.0 - (02/12/2011)
 * @requires 
 * @author Andreas Bourakis (bourakis@gmail.com)
 * @Description: TMethods for managing Mysql database.
 
 * Licensed under MIT licence:
 *   http://www.opensource.org/licenses/mit-license.php
 *  TODO:
 *
**/


class Db
{
    function init()
    {
        echo "TEST!!!";
    }
    
        
    function connect($host, $username, $pass, $db)
    {        
        mysql_connect($host, $username, $pass);
        mysql_select_db($db);
    }
  
    
    function close()
    {
        mysql_close();
    }
    

    function getContent($c_id, $lang_id)
    {
        $result = mysql_query("SELECT content
                               FROM ContentsLang
                               WHERE Languages_id=$lang_id AND Contents_id=$c_id ");
        
        $row = mysql_fetch_array($result);
        
        return array('title'=>$row['title'],
                     'content'=>$row['content']);
    }


    function getTagContent($tag_name, $content_id)
    {
        $sql1 = "
        SELECT title, content
        FROM Contents_lang
        WHERE Languages_id=$_SESSION[lang_id]
              AND Contents_id IN
                                 (SELECT id
                                 FROM Contents
                                 WHERE id=$content_id AND
                                       tag='$tag_name' AND
                                       active=1 AND
                                       del=0)        
        ";

        $sql2 = "
        SELECT title, content
        FROM Contents_lang
        WHERE Languages_id=$_SESSION[lang_id]
              AND Contents_id IN
                                 (SELECT id
                                 FROM Contents
                                 WHERE tag='$tag_name' AND
                                       active=1 AND
                                       default_val=1 AND
                                       del=0)        
        ";



        if(is_null($content_id) || $content_id == "")
            $sql = $sql2;
        else
            $sql = $sql1;

        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
        
        //return $row['title'].",".$row['content'];
        return $row['content'];
    }



    
    // Used by Class: Multilang
    function getLangId($lang)
    {
        $result = mysql_query("SELECT id
                               FROM Languages
                               WHERE language='$lang' OR prefix='$lang' ");
        
        $row = mysql_fetch_array($result);
        
        return $row['id'];
    }


    function getLang($lang_id)
    {
        $result = mysql_query("SELECT language, prefix
                               FROM Languages
                               WHERE id=$lang_id ");
        
        $row = mysql_fetch_array($result);
        
        return $row['language'].",".$row['prefix'];        
    }

}

?>