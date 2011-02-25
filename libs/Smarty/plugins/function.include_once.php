<?php

/**
 *
 * @param type $params
 * @param Smarty $smarty
 * @return type 
 */
function smarty_function_include_once($params, & $smarty) {
    if (!isset($params["file"]))
        return "";
    
    static $alreadyIncluded = array();
    
    $hash = md5($params["file"]);
    
    if (isset($alreadyIncluded[$hash]))
        return "";

    $alreadyIncluded[$hash] = 1;
    
    $smarty->display($params["file"]);
}
?>
