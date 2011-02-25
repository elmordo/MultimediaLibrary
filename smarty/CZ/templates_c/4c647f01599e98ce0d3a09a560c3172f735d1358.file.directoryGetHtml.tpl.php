<?php /* Smarty version Smarty3-RC3, created on 2011-02-21 21:49:22
         compiled from "/media/WorkFlash/Projekty/MultimediaLibrary/config/../smarty/CZ/templates/directoryGetHtml.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3218263754d62cfd2eac925-45692727%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4c647f01599e98ce0d3a09a560c3172f735d1358' => 
    array (
      0 => '/media/WorkFlash/Projekty/MultimediaLibrary/config/../smarty/CZ/templates/directoryGetHtml.tpl',
      1 => 1298321361,
    ),
  ),
  'nocache_hash' => '3218263754d62cfd2eac925-45692727',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<?php  $_smarty_tpl->tpl_vars['parent'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('path')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['parent']->key => $_smarty_tpl->tpl_vars['parent']->value){
?>
/<a href="/directory/<?php echo $_smarty_tpl->getVariable('parent')->value->id;?>
_<?php echo $_smarty_tpl->getVariable('parent')->value->directory_name;?>
"><?php echo $_smarty_tpl->getVariable('parent')->value->directory_name;?>
</a>
<?php }} ?>
<h1>/<?php echo $_smarty_tpl->getVariable('this')->value->directory_name;?>
</h1>
<?php if ($_smarty_tpl->getVariable('permisions')->value->write){?>
<h2>Přejmenovat adresář</h2>
<form action="/directory/<?php echo $_smarty_tpl->getVariable('this')->value->id;?>
_<?php echo $_smarty_tpl->getVariable('this')->value->directory_name;?>
/put" method="post">
    Nové jméno: <input type="text" name="directory[directory_name]" /><br />
    <input type="submit" value="Přejmenovat adresář" />
</form>
<?php }?>
<?php if ($_smarty_tpl->getVariable('this')->value->user_id==$_smarty_tpl->getVariable('_user')->value->id){?>
<h2>Změnit oprávění</h2>
<form action="/directory/<?php echo $_smarty_tpl->getVariable('this')->value->id;?>
_<?php echo $_smarty_tpl->getVariable('this')->value->directory_name;?>
/put" method="post">
    Nové oprávnění: <input type="text" name="directory[mask]" value="<?php echo $_smarty_tpl->getVariable('this')->value->mask;?>
" /><br />
    <input type="submit" value="Uložit změny v oprávnění" />
</form>
<?php }?>
<h2>Obsah adresáře</h2>
<table>
    <thead>
        <tr>
            <th>
                Typ
            </th>
            <th>
                Jméno
            </th>
            <th>
                Uživatel
            </th>
            <th>
                Skupina
            </th>
            <th>
                Oprávnění
            </th>
            <th>
                Vytvořen
            </th>
            <th>
                Poslední změna
            </th>
            <th>
                Operace
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                D
            </td>
            <td>
                <a href="/directory/<?php echo $_smarty_tpl->getVariable('this')->value->id;?>
_<?php echo $_smarty_tpl->getVariable('this')->value->directory_name;?>
">.</a>
            </td>
            <td>
                <?php echo $_smarty_tpl->getVariable('this')->value->user_id;?>

            </td>
            <td>
                <?php echo $_smarty_tpl->getVariable('this')->value->group_id;?>

            </td>
            <td>
                <?php echo $_smarty_tpl->getVariable('this')->value->mask;?>

            </td>
            <td>
                <?php echo $_smarty_tpl->getVariable('this')->value->created_at;?>

            </td>
            <td>
                -
            </td>
            <td>
                -
            </td>
        </tr>
        <tr>
            <td>
                D
            </td>
            <td>
                <a href="/directory/<?php echo $_smarty_tpl->getVariable('directParent')->value->id;?>
_<?php echo $_smarty_tpl->getVariable('directParent')->value->directory_name;?>
">..</a>
            </td>
            <td>
                <?php echo $_smarty_tpl->getVariable('directParent')->value->user_id;?>

            </td>
            <td>
                <?php echo $_smarty_tpl->getVariable('directParent')->value->group_id;?>

            </td>
            <td>
                <?php echo $_smarty_tpl->getVariable('directParent')->value->mask;?>

            </td>
            <td>
                <?php echo $_smarty_tpl->getVariable('directParent')->value->created_at;?>

            </td>
            <td>
                -
            </td>
            <td>
                -
            </td>
        </tr>
        <?php  $_smarty_tpl->tpl_vars['dir'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('subdirs')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['dir']->key => $_smarty_tpl->tpl_vars['dir']->value){
?>
        <tr>
            <td>
                D
            </td>
            <td>
                <a href="/directory/<?php echo $_smarty_tpl->getVariable('dir')->value->id;?>
_<?php echo $_smarty_tpl->getVariable('dir')->value->directory_name;?>
"><?php echo $_smarty_tpl->getVariable('dir')->value->directory_name;?>
</a>
            </td>
            <td>
                <?php echo $_smarty_tpl->getVariable('dir')->value->user_id;?>

            </td>
            <td>
                <?php echo $_smarty_tpl->getVariable('dir')->value->group_id;?>

            </td>
            <td>
                <?php echo $_smarty_tpl->getVariable('dir')->value->mask;?>

            </td>
            <td>
                <?php echo $_smarty_tpl->getVariable('dir')->value->created_at;?>

            </td>
            <td>
                -
            </td>
            <td>
                <a href="/directory/<?php echo $_smarty_tpl->getVariable('dir')->value->id;?>
_<?php echo $_smarty_tpl->getVariable('dir')->value->directory_name;?>
/delete">Smazat</a>
            </td>
        </tr>
        <?php }} ?>
	<?php  $_smarty_tpl->tpl_vars['file'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('files')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if (count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['file']->key => $_smarty_tpl->tpl_vars['file']->value){
?>
	<tr>
            <td>
                F
            </td>
            <td>
                <a href="/document/<?php echo $_smarty_tpl->getVariable('file')->value->uuid;?>
_<?php echo $_smarty_tpl->getVariable('file')->value->document_name;?>
"><?php echo $_smarty_tpl->getVariable('file')->value->document_name;?>
</a>
            </td>
            <td>
                <?php echo $_smarty_tpl->getVariable('file')->value->user_id;?>

            </td>
            <td>
                <?php echo $_smarty_tpl->getVariable('file')->value->group_id;?>

            </td>
            <td>
                <?php echo $_smarty_tpl->getVariable('file')->value->mask;?>

            </td>
            <td>
                <?php echo $_smarty_tpl->getVariable('file')->value->created_at;?>

            </td>
            <td>
                -
            </td>
            <td>
                <a href="/document/<?php echo $_smarty_tpl->getVariable('file')->value->uuid;?>
_<?php echo $_smarty_tpl->getVariable('file')->value->document_name;?>
/put?directory[id]=<?php echo $_smarty_tpl->getVariable('this')->value->id;?>
&directory[method]=delete">Odebrat</a>
            </td>
        </tr>
	<?php }} ?>
    </tbody>
</table>
<?php if ($_smarty_tpl->getVariable('permisions')->value->write){?>
<h2>Přidat adresář</h2>
<form action="/directory/<?php echo $_smarty_tpl->getVariable('this')->value->id;?>
_<?php echo $_smarty_tpl->getVariable('this')->value->directory_name;?>
/post" method="post">
    Jméno nového adresáře: <input type="text" name="directory[directory_name]" /><br />
    <input type="submit" value="Vytvořit adresář" />
</form>
<h2>Přidat dokument</h2>
<form action="/document/post" method="post" enctype="multipart/form-data">
    Soubor: <input type="file" name="document[content]" /><br />
    <input type="hidden" name="directory[id]" value="<?php echo $_smarty_tpl->getVariable('this')->value->id;?>
" />
    <input type="submit" value="Odeslat dokument" />
</form>
<?php }?>
<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>