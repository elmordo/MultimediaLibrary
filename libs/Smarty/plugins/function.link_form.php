<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function smarty_function_link_form($params, &$smarty) {
    //kontrola, jeslti jsou zadany vechny parametry
    if (!isset($params["instance"]) || !isset($params["controller"]))
	return "";

    //kontrola akce
    if (!isset($params["action"]))
	$params["action"] = "index";

    //sestaveni linku
    $link = $params["instance"]["name"]."_".$params["instance"]["id"]."/".$params["controller"]."/".$params["action"];

    return $link;
}
?>