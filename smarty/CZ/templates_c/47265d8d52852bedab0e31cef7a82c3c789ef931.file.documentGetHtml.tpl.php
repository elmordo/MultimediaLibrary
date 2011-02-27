<?php /* Smarty version Smarty3-RC3, created on 2011-02-27 11:43:51
         compiled from "/home/petr/NetBeansProjects/MultimediaLibrary/config/../smarty/CZ/templates/documentGetHtml.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11983832154d6a2ae7867cb6-42453479%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '47265d8d52852bedab0e31cef7a82c3c789ef931' => 
    array (
      0 => '/home/petr/NetBeansProjects/MultimediaLibrary/config/../smarty/CZ/templates/documentGetHtml.tpl',
      1 => 1298754590,
    ),
  ),
  'nocache_hash' => '11983832154d6a2ae7867cb6-42453479',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<h1>Dokument <?php echo $_smarty_tpl->getVariable('document')->value->document_name;?>
</h1>
Vytvořen: <?php echo $_smarty_tpl->getVariable('document')->value->created_at;?>
<br />
Majitel: <?php echo $_smarty_tpl->getVariable('document')->value->user_id;?>
<br />
Skupina: <?php echo $_smarty_tpl->getVariable('document')->value->group_id;?>
<br />
Oprávnění: <?php echo $_smarty_tpl->getVariable('document')->value->mask;?>
<br />
Velikost: <?php echo $_smarty_tpl->getVariable('document')->value->size;?>
 B<br />
<?php if ($_smarty_tpl->getVariable('permisions')->value->read){?>
<a href="/document/get/<?php echo $_smarty_tpl->getVariable('document')->value->uuid;?>
_<?php echo $_smarty_tpl->getVariable('document')->value->document_name;?>
">Stáhnout</a>
<?php }?>
<h2>Aktuální verze</h2>
<?php if ($_smarty_tpl->getVariable('document')->value->is_latest){?>
Toto je aktuální verze
<?php }else{ ?>
Vytvořen: <?php echo $_smarty_tpl->getVariable('master')->value->created_at;?>
<br />
Majitel: <?php echo $_smarty_tpl->getVariable('master')->value->user_id;?>
<br />
Skupina: <?php echo $_smarty_tpl->getVariable('master')->value->group_id;?>
<br />
Oprávnění: <?php echo $_smarty_tpl->getVariable('master')->value->mask;?>
<br />
Velikost: <?php echo $_smarty_tpl->getVariable('master')->value->size;?>
 B<br />
<a href="/document/<?php echo $_smarty_tpl->getVariable('master')->value->uuid;?>
_<?php echo $_smarty_tpl->getVariable('master')->value->document_name;?>
.html">Zobrazit</a>
<?php }?>
<?php if ($_smarty_tpl->getVariable('document')->value->is_latest){?>
<h2>Úpravy</h2>
<form action="/document/<?php echo $_smarty_tpl->getVariable('document')->value->uuid;?>
_<?php echo $_smarty_tpl->getVariable('document')->value->document_name;?>
/put" method="post" enctype="multipart/form-data">
    <?php if ($_smarty_tpl->getVariable('permisions')->value->write){?>
Jméno dokumentu: <input type="text" name="document[document_name]" value="<?php echo $_smarty_tpl->getVariable('document')->value->document_name;?>
" /><br />
Nová revize: <input type="file" name="document[content]" /><br />
    <?php }?>
    <?php if ($_smarty_tpl->getVariable('user')->value->id==$_smarty_tpl->getVariable('document')->value->user_id){?>
    Maska oprávnění: <input type="text" name="document[mask]" value="<?php echo $_smarty_tpl->getVariable('document')->value->mask;?>
" /><br />
    <?php }?>
    <input type="submit" value="Zapsat změny" />
</form>
<?php }?>
<h2>Historie dokumentu</h2>
<ol>
    <?php  $_smarty_tpl->tpl_vars['history'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('histories')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['history']->key => $_smarty_tpl->tpl_vars['history']->value){
?>
    <li><a href="/document/<?php echo $_smarty_tpl->getVariable('history')->value->document_old_uuid;?>
"><?php echo $_smarty_tpl->getVariable('history')->value->created_at;?>
</a></li>
    <?php }} ?>
</ol>
<h2>Adresáře</h2>
<ul>
    <?php  $_smarty_tpl->tpl_vars['directory'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('directories')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['directory']->key => $_smarty_tpl->tpl_vars['directory']->value){
?>
    <li>
	<a href="/directory/<?php echo $_smarty_tpl->getVariable('directory')->value->id;?>
_<?php echo $_smarty_tpl->getVariable('directory')->value->directory_name;?>
"><?php echo $_smarty_tpl->getVariable('directory')->value->directory_name;?>
</a>
    </li>
    <?php }} ?>
</ul>
<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>