<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function smarty_function_translate_message($params, &$smarty) {
    if (!isset($params["dictonary"]))
	return $params["message"];

    /* @var $dictonary Standard_System_MessageTranslator */
    static $dictonary = null;
    static $oldFile = null;

    if ($oldFile != $params["dictonary"]) {
	$dictonary = new Standard_System_MessageTranslator(PATH_TRANSLATIONS.$params["dictonary"]);
	$oldFile = $params["dictonary"];
    }
    
    return $dictonary->translate($params["message"]);
}
?>
