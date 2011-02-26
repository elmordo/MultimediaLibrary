<?php /* Smarty version Smarty3-RC3, created on 2011-02-26 12:57:01
         compiled from "/home/petr/NetBeansProjects/MultimediaLibrary/config/../smarty/CZ/templates/userGetHtml.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3228707604d68ea8d28b649-07330761%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'af8d866637f43cb70c1d9e5cbb8071fe07a9cb0c' => 
    array (
      0 => '/home/petr/NetBeansProjects/MultimediaLibrary/config/../smarty/CZ/templates/userGetHtml.tpl',
      1 => 1298317214,
    ),
  ),
  'nocache_hash' => '3228707604d68ea8d28b649-07330761',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Uživatel <?php echo $_smarty_tpl->getVariable('user')->value->username;?>
</h1>
ID: <?php echo $_smarty_tpl->getVariable('user')->value->id;?>
<br />
E-Mail: <?php echo $_smarty_tpl->getVariable('user')->value->email;?>

<h2>Role uživatele</h2>
<ul>
    <?php  $_smarty_tpl->tpl_vars['role'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('roles')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['role']->key => $_smarty_tpl->tpl_vars['role']->value){
?>
    <li><?php echo $_smarty_tpl->getVariable('role')->value->role_name;?>
</li>
    <?php }} ?>
</ul>
<h2>Skupiny uživatele</h2>
<ul>
    <?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('groups')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value){
?>
    <li><?php echo $_smarty_tpl->getVariable('role')->value->group_name;?>
</li>
    <?php }} ?>
</ul>
<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>