<?php

class View
{
    function set($filename, $data = null)
    {
        extract($data);
        require_once $filename;
    }
}    

?>