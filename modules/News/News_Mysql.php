<?php
/*
--------------------------------------------------------------------------------  
 MC Framework :: News :: Mysql

 Description:
 Queries for Mysql platform on News module.
 
 Creation Date: 31/01/2012
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



class News_Mysql
{
    /** 
    * Function: getTagImages
    *
    * Description: Returns the images filename for a Content row by tag name or
    *              id.
    *
    * TODO:
    *
    * @param Content tag name in DB
    * @param Content Id
    * @return Images filename
    *
    **/    
    function getTagImages($content_tag_name, $id)
    {
        $sql_by_tag = "SELECT filename
                               FROM Images
                               WHERE id IN
                                    (SELECT Images_id
                                     FROM Images_has_Contents
                                     WHERE Contents_id IN
                                        (SELECT id
                                         FROM Contents
                                         WHERE tag='$content_tag_name' AND active=1))";
        
        $sql_by_id = "SELECT filename
                               FROM Images
                               WHERE main=1 AND
                                     id IN
                                     (SELECT Images_id
                                      FROM Images_has_Contents
                                      WHERE Contents_id IN
                                         (SELECT id
                                          FROM Contents
                                          WHERE id='$id' AND active=1))";
        
        if(isset($content_tag_name)) 
            $sql = $sql_by_tag;
        elseif(isset($id)) 
            $sql = $sql_by_id;
        
        $result = mysql_query($sql);
                
        return $result;
    }

}

?>