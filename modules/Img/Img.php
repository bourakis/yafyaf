<?php
/*
--------------------------------------------------------------------------------  
 MC Framework :: Img.php

 Description:
 This is a framework module for image management.
 
 Creation Date: 02/12/2011
 Updated: 04/01/2012

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


//Load DB platform Class queries
include_once F_ABSPATH."/app/modules/Img/Img_Html.php";


class Img extends Img_Html
{
    // init() is called automatically when a Module is loaded.
    function init()
    {
        
    }


    function img_upload()
    {
       /* I will use another class as standard uploader and I'll call it here */
    }

}

?>