<?php
function smarty_block_form($params, $content, & $smarty, $repeat) {
    if (!$repeat)
	return "</form>";

    return $content;
}
?>
