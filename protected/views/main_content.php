<?php
/**
 * Created by JetBrains PhpStorm.
 * User: andreasmpourakes
 * Date: 7/14/12
 * Time: 6:09 PM
 * To change this template use File | Settings | File Templates.
 */

$html = "

    <div class=\"doc\">
        ".$data['brief']."
    </div>

    <h2 class=\"header2\">".$data['skills']."</h2>
    <div class=\"doc\">
        ".$data['skills_doc']."
    </div>

    <h2 class=\"header2\">".$data['expertise']."</h2>
    <div class=\"doc\">
        ".$data['expertise_doc']."
    </div>
";


return $html;

?>