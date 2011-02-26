<?php /* Smarty version Smarty3-RC3, created on 2011-02-26 12:55:27
         compiled from "/home/petr/NetBeansProjects/MultimediaLibrary/config/../smarty/CZ/templates/userGetJson.tpl" */ ?>
<?php /*%%SmartyHeaderCode:286699284d68ea2f6e5832-50598570%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f6b48a517b5c0dc57c5d8df56594d92033a1b5ff' => 
    array (
      0 => '/home/petr/NetBeansProjects/MultimediaLibrary/config/../smarty/CZ/templates/userGetJson.tpl',
      1 => 1298455172,
    ),
  ),
  'nocache_hash' => '286699284d68ea2f6e5832-50598570',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_block_php')) include '/home/petr/NetBeansProjects/MultimediaLibrary/libs/Smarty/plugins/block.php.php';
?><?php $_smarty_tpl->smarty->_tag_stack[] = array('php', array()); $_block_repeat=true; smarty_block_php(array(), null, $_smarty_tpl->smarty, $_block_repeat, $_smarty_tpl);while ($_block_repeat) { ob_start();?>

//informace o uzivateli
$user = $smarty->getTemplateVars("user");

$userArr = array(
    "id" => $user->id,
    "username" => $user->username,
    "email" => $user->email,
    "root_directory_id" => $user->root_directory_id
);

//informace o rolich
$roles = $smarty->getTemplateVars("roles");
$roleArr = array();

foreach ($roles as $role) {
    $roleArr[] = array(
        "id" => $role->id,
        "role_name" => $role->role_name
    );
}

//informace o skupinach
$groups = $smarty->getTemplateVars("groups");
$groupArr = array();

foreach ($groups as $group) {
    $roleArr[] = array(
        "id" => $group->id,
        "group_name" => $group->group_name
    );
}

$response = array(
    "user" => $userArr,
    "group" => $groupArr,
    "role" => $roleArr
);

echo Zend_Json::encode($response);
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_php(array(), $_block_content, $_smarty_tpl->smarty, $_block_repeat, $_smarty_tpl); } array_pop($_smarty_tpl->smarty->_tag_stack);?>
