<?php

$html .= "
<table border=\"1\">
<tr><td>
        Title
    </td>
</tr>
";

foreach ($data as $element): 

    $html .= "
    <tr><td>
            $element->title
        </td>
    </tr>
    ";

endforeach; 

$html .= "
</table>
";

return $html;
?>