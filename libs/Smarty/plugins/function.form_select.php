<?php
function smarty_function_form_select($params, & $smarty) {
    $name = "";
    $for = "";
    $style = "";
    $class = "";
    $items = null;
    $selected = null;
    $itemDelimiter = ";";
    $keyDelimiter = ":";

    foreach ($params as $key => $val) {
	switch ($key) {
	    case "name":
	    case "for":
	    case "style":
	    case "class":
	    case "selected":
	    case "itemDelimiter":
	    case "keyDelimiter":
	    case "items":
		$$key = $val;
		break;
	}
    }

    //naparsovani itemu
    $preparsed = explode($itemDelimiter, $items);
    $values = array();

    foreach ($preparsed as $pair) {
	list($key, $value) = explode($keyDelimiter, $pair);

	$values[$key] = $value;
    }

    //vygenerovani optionu
    $options = array();

    //kontrola jeslti podle jmena ma but input pole
    if ($pos = strpos($name, "[")) {
	$array = substr($name, $pos);
	$name = substr($name, 0, $pos);
    } else {
	$array = "";
    }

    foreach ($values as $key => $val) {
	$option = "<option value=\"".$key."\"";

	if ($key == $selected)
	    $option.= 'selected="selected"';

	$option .= ">".$val."</option>";

	$options[] = $option;
    }

    //sestaveni jmena
    if ($for)
	$selectName = $for."[$name]$array";
    else
	$selectName = "$name$array";

    //vygenerovani zbytku
    $retval = "<select name=\"$selectName\">$style$class>\n".implode("\n", $options)."\n</select>";

    return $retval;
}
?>
