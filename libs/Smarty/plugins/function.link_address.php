<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function smarty_function_link_address($params, &$smarty) {
    //kontrola, jeslti jsou zadany vechny parametry
    if (!isset($params["instance"]) || !isset($params["controller"]))
	return "";

    //kontrola akce
    if (!isset($params["action"]))
	$params["action"] = "index";
    
    //sestaveni linku
    $link = "/".$params["instance"]["name"]."_".$params["instance"]["id"];

    if (isset($params["mode"]))
	$link .= "_".$params["mode"];

    $link .= "/".$params["controller"]."/".$params["action"];

    if (isset($params["params"]))
	$queryString = "?".$params["params"];
    else
	$queryString = "";

    $retval = "<a href=\"$link$queryString\">".$params["legend"]."</a>";

    return $retval;
}
?>
