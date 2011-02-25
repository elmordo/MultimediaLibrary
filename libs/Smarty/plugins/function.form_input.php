<?php
function smarty_function_form_input($params, & $smarty) {
    //kontorla povinnych hodnot
    if (!(isset($params["name"])))
	return "";

    //inicializace hodnot
    $notEscape = false;
    $name = "";
    $for = null;
    $checked = "";
    $style = "";
    $class = "";
    $type = "text";
    $value = "";

    foreach ($params as $key => $val) {
	switch ($key) {
	    case "type":
	    case "name":
	    case "for":
	    case "notEscape":
	    case "value":
		$$key = $val;
		break;

	    case "checked":
		$$key = " checked=\"checked\"";
		break;

	    case "style":
		$$key = " style=\"$val\"";
		break;

	    case "class":
		$$key = " class=\"$val\"";
		break;
	}
    }

    //kontrola jeslti podle jmena ma but input pole
    if ($pos = strpos($name, "[")) {
	 $array = substr($name, $pos);
	 $name = substr($name, 0, $pos);
    } else {
	$array = "";
    }
    
    //sestaveni jmena
    if (is_null($for))
	$inputName = $name.$array;
    else
	$inputName = $for."[$name]$array";

    //sestaveni vysledku
    if ($type == "textarea")
	$retval = "<textarea name=\"$inputName\"$style$class>$value</textarea>";
    else
	$retval = "<input type=\"$type\" name=\"$inputName\" value=\"$value\"$checked$style$class />";

    return $retval;
}
?>
