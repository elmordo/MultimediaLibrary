<?php

function smarty_modifier_generate_id($name, $prefix = null) {
    //kontrola jestli existuje prefix
    $retVal = "";

    if (!is_null($prefix))
        $retVal = $prefix . "-";

    //vygenerovani zbytku id
    $maxI = strlen($name);

    for ($i = 0; $i != $maxI; $i++) {
        switch ($name[$i]) {
            case "[":
                $retVal .= "-";
                break;
            
            case "]":
                break;
            
            default:
                $retVal .= $name[$i];
        }
    }
    
    return $retVal;
}

?>
