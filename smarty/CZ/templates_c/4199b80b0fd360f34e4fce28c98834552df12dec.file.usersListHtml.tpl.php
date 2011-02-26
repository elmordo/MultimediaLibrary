<?php /* Smarty version Smarty3-RC3, created on 2011-02-26 13:10:19
         compiled from "/home/petr/NetBeansProjects/MultimediaLibrary/config/../smarty/CZ/templates//usersListHtml.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5348190844d68edabe60ea3-05898700%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4199b80b0fd360f34e4fce28c98834552df12dec' => 
    array (
      0 => '/home/petr/NetBeansProjects/MultimediaLibrary/config/../smarty/CZ/templates//usersListHtml.tpl',
      1 => 1298722218,
    ),
  ),
  'nocache_hash' => '5348190844d68edabe60ea3-05898700',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Seznam uživatelů</h1>
<table>
    <thead>
	<tr>
	    <th>
		#
	    </th>
	    <th>
		Uživatelské jméno
	    </th>
	    <th>
		E-mail
	    </th>
	</tr>
    </thead>
    <tbody>
	<?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('users')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
?>
	<tr>
	    <td>
		<?php echo $_smarty_tpl->getVariable('user')->value->id;?>

	    </td>
	    <td>
		<?php echo $_smarty_tpl->getVariable('user')->value->username;?>

	    </td>
	    <td>
		<?php echo $_smarty_tpl->getVariable('user')->value->email;?>

	    </td>
	</tr>
	<?php }} ?>
    </tbody>
</table>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>