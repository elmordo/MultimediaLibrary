<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @param array $params
 * @param Smarty $smarty
 * @return string
 */
function smarty_function_print_messages($params, &$smarty) {
    $list = array();

    $smarty->loadPlugin("smarty_function_translate_message");

    foreach ($params["messages"] as $message) {
	$list[] = smarty_function_translate_message(array(
	    "message" => $message,
	    "dictonary" => $params["dictonary"]), $smarty);
    }
    
    if (!isset($params["delimiter"]))
	$params["delimiter"] = "<br />";

    return implode($params["delimiter"], $list);
}
?>
