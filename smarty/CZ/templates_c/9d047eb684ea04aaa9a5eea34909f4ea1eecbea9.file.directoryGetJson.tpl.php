<?php /* Smarty version Smarty3-RC3, created on 2011-02-26 12:55:27
         compiled from "/home/petr/NetBeansProjects/MultimediaLibrary/config/../smarty/CZ/templates/directoryGetJson.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16488509154d68ea2fad83b2-08599127%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9d047eb684ea04aaa9a5eea34909f4ea1eecbea9' => 
    array (
      0 => '/home/petr/NetBeansProjects/MultimediaLibrary/config/../smarty/CZ/templates/directoryGetJson.tpl',
      1 => 1298531117,
    ),
  ),
  'nocache_hash' => '16488509154d68ea2fad83b2-08599127',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_php')) include '/home/petr/NetBeansProjects/MultimediaLibrary/libs/Smarty/plugins/block.php.php';
?><?php $_smarty_tpl->smarty->_tag_stack[] = array('php', array()); $_block_repeat=true; smarty_block_php(array(), null, $_smarty_tpl->smarty, $_block_repeat, $_smarty_tpl);while ($_block_repeat) { ob_start();?>

//informace o adresari
$directoryArr = $smarty->getTemplateVars("this")->toArray();

//informace o podrazenych adresarich
$subdirsArr = $smarty->getTemplateVars("subdirs")->toArray();

//informace o podrazenych souborech
$filesArr = $smarty->getTemplateVars("files")->toArray();

//informace o ceste
$path = $smarty->getTemplateVars("path");
$pathArr = array();

foreach ($path as $segment)
    $pathArr[] = $segment->toArray();

$response = array(
    "directory" => $directoryArr,
    "subdirs" => $subdirsArr,
    "files" => $filesArr,
    "path" => $pathArr
);

echo Zend_Json::encode($response);
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_php(array(), $_block_content, $_smarty_tpl->smarty, $_block_repeat, $_smarty_tpl); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
