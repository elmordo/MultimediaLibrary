<?php
/**
 * Vygeneruje skryte pole
 * @param array $params vstupni parametry
 * @param Smarty $smarty instance smarty
 * @return type
 */

function smarty_function_form_radio(array $params, & $smarty) {
    //kontrola odeslanych parametru
    if (!isset($params["name"])) {
        throw new Exception("Name must be set");
        return "";
    }

    $smarty->loadPlugin("smarty_modifier_generate_id");

    //vygenerovani id
    $attribs = array(
        "id" => smarty_modifier_generate_id($params["name"]),
        "name" => $params["name"]
    );

    if (isset($params["value"])) {
        $attribs["value"] = $params["value"];
    }

    //kontrola jeslti ma byt pole vybrano
    if (isset($params["currentValue"])) {
	if ($params["currentValue"] == $params["value"])
	    $attribs["checked"] = "checked";
    }

    //prepsani atributu
    if (isset($params["attribs"])) {
        foreach ($params["attribs"] as $attrName => $attribute)
            $attribs[$attrName] = $attribute;
    }

    //vygenerovani vysledku
    $retVal = "<input type=\"radio\"";

    foreach ($attribs as $attrName => $attribute)
        $retVal .= " $attrName=\"$attribute\"";

    $retVal .= " />";

    return $retVal;
}
?>
