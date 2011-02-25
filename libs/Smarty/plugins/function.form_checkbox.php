<?php
/**
 * Vygeneruje zaskrtavaci pole
 * @param array $params vstupni parametry
 * @param Smarty $smarty instance smarty
 * @return type
 */

function smarty_function_form_checkbox(array $params, & $smarty) {
    //kontrola odeslanych parametru
    if (!isset($params["name"])) {
        throw new Exception("Name must be set");
        return "";
    }

    //nacteni dodatecnych pluginu
    $smarty->loadPlugin("smarty_modifier_generate_id");
    $smarty->loadPlugin("smarty_function_form_hidden");

    //vygenerovani id
    $attribs = array(
        "id" => smarty_modifier_generate_id($params["name"]),
        "name" => $params["name"]
    );

    if (isset($params["value"])) {
        $attribs["value"] = $params["value"];
    }

    //prepsani atributu
    if (isset($params["attribs"])) {
        foreach ($params["attribs"] as $attrName => $attribute)
            $attribs[$attrName] = $attribute;
    }

    //vygenerovani defaultni hodnoty
    if (!isset($params["default"]))
        $params["default"] = 0;

    //uprava parametru pro hidden
    $hiddenParams = $params;
    $hiddenParams["value"] = $params["default"];

    $retVal = smarty_function_form_hidden($hiddenParams, $smarty);

    //vygenerovani vysledku
    $retVal .= "<input type=\"checkbox\"";

    foreach ($attribs as $attrName => $attribute)
        $retVal .= " $attrName=\"$attribute\"";

    $retVal .= " />";

    return $retVal;
}
?>
