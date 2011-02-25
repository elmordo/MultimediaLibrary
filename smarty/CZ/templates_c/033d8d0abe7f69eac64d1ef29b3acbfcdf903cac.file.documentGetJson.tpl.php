<?php /* Smarty version Smarty3-RC3, created on 2011-02-21 21:27:23
         compiled from "/media/WorkFlash/Projekty/MultimediaLibrary/config/../smarty/CZ/templates/documentGetJson.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4324432004d62caabe941c9-58386675%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '033d8d0abe7f69eac64d1ef29b3acbfcdf903cac' => 
    array (
      0 => '/media/WorkFlash/Projekty/MultimediaLibrary/config/../smarty/CZ/templates/documentGetJson.tpl',
      1 => 1298320042,
    ),
  ),
  'nocache_hash' => '4324432004d62caabe941c9-58386675',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_php')) include '/media/WorkFlash/Projekty/MultimediaLibrary/libs/Smarty/plugins/block.php.php';
?><?php $_smarty_tpl->smarty->_tag_stack[] = array('php', array()); $_block_repeat=true; smarty_block_php(array(), null, $_smarty_tpl->smarty, $_block_repeat, $_smarty_tpl);while ($_block_repeat) { ob_start();?>

//informace o dokumentu
$document = $smarty->getTemplateVars("document");
$documentArr = $document->toArray();

//informace o hlavnim dokumentu
$master = $smarty->getTemplateVars("master");
$masterArr = $document->toArray();

//zapis adresaru
$directories = $smarty->getTemplateVars("directories");
$directoriesArr = $directories->toArray();

//zapis historie
$histories = $smarty->getTEmplateVars("histories");
$historiesArr = array();

foreach ($histories as $history) {
    $history = $history->toArray();
    unset($history["id"]);

    $historiesArr[] = $history;
}

//zapis vysledku
$response = array(
    "document" => $documentArr,
    "master" => $masterArr,
    "directory" => $directoriesArr,
    "history" => $historiesArr
);

echo Zend_Json::encode($response);
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_php(array(), $_block_content, $_smarty_tpl->smarty, $_block_repeat, $_smarty_tpl); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
