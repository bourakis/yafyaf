<?php

class MainModel
{

    function query1($params)
    {
        //print_r($params);
        
        $q = mysql_query("SELECT title, text FROM Posts") or die(mysql_error());;
        
        $collector =  array();
        
        while($obj = mysql_fetch_object($q))
        {
            $collector[] = $obj;
        }
        
        return $collector;
    }
    
}

?>