<?php
/*
--------------------------------------------------------------------------------  
 MC Framework :: Img :: Html

 Description:
 Html parts of the module
 
 Creation Date: 12/01/2012
 Updated: 

 Author: Andreas Bourakis (bourakis@gmail.com)
 Contributor:
 
--------------------------------------------------------------------------------  
 TODO:
 
-------------------------------------------------------------------------------- 

M.I.T. License
Copyright (C) 2012 omicro.net & mclab.gr

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation  files  (the "Software"), to deal in
the Software without  restriction, including without  limitation the  rights to
use, copy, modify, merge, publish, distribute,  sublicense, and/or  sell copies
of the Software, and to permit persons to  whom the Software is furnished to do
so, subject to the following conditions:

The above copyright notice and this permission  notice shall be included in all
copies or substantial portions of the Software.

THE  SOFTWARE  IS  PROVIDED "AS IS", WITHOUT  WARRANTY  OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING  BUT  NOT  LIMITED  TO  THE  WARRANTIES  OF  MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND  NONINFRINGEMENT.  IN  NO  EVENT SHALL THE
AUTHORS  OR  COPYRIGHT  HOLDERS BE  LIABLE  FOR  ANY  CLAIM,  DAMAGES  OR OTHER
LIABILITY, WHETHER IN AN  ACTION  OF CONTRACT, TORT OR  OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH  THE  SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE. */

/*  Usage:
    function form1($content)
    {
        include_once "html/forms_html.php";
    }
*/



//Load DB platform Class queries
include_once F_ABSPATH."/app/modules/Img/Img_Mysql.php";


class Img_Html extends Img_Mysql
{
    public static $imgs = array();


    /** 
    * Function: getImgByContentTag
    *
    * Description: Insert the tag name of Content table and returns html
    *              Image tags.
    *
    * TODO:
    *
    * @param Content tag name in DB
    * @param 1=return Main img, 0=Return all imgs with this Content tag.
    * @return html images
    *
    **/
    function getImgByContentTag($tag_name, $is_main)
    {
        if($is_main)
        {
            // Return the main image for a specific tag name from Contents Table.
            $res = Img_Mysql::getMainImage($tag_name, "");
        }
        else
        {
            // Get image names for a specific tag of Content table in DB.
            $res = Img_Mysql::getTagImages($tag_name, "");
        }
        
        $x=0;
        while($row = mysql_fetch_array($res))
        {
            self::$imgs[$x] = $row[0];
            $x++;
        }

        for($i=0; $i<$x; $i++)
        {
            echo "<img src=\"uploads/".self::$imgs[$i]."\" width=\"100\">";
        }
    }
    
    
    /** 
    * Function: getImgByContentId
    *
    * Description: Insert the ID of Content table and returns html
    *              Image tags.
    *
    * TODO:
    *
    * @param Content ID
    * @param 1=return Main img, 0=Return all imgs with this Content tag.
    * @return html images
    *
    **/
    function getImgByContentId($content_id, $main_img)
    {
        if($main_img)
        {
            // Return the main image for a specific tag name from Contents Table.
            $res = Img_Mysql::getMainImage($tag_name, $id);
        }
        else
        {
            // Get image names for a specific tag OR id of Content table in DB.
            $res = Img_Mysql::getTagImages($tag_name, $id);
        }
        
        $x=0;
        while($row = mysql_fetch_array($res))
        {
            self::$imgs[$x] = $row[0];
            $x++;
        }

        for($i=0; $i<$x; $i++)
        {
            echo "<img src=\"uploads/".self::$imgs[$i]."\" width=\"100\">";
        }        
    }
    
}

?>