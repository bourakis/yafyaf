<?php

$html .= "
<table border=\"1\">
<tr><td>
        Title
    </td>
    <td>
        Text
    </td>
</tr>
";

foreach ($data as $element): 

    $html .= "
    <tr><td>
            $element->title
        </td>
        <td>
            $element->text
        </td>
    </tr>
    ";

endforeach; 

$html .= "
</table>
";

return $html;
?>