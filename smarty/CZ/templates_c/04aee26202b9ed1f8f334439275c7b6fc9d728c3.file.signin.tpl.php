<?php /* Smarty version Smarty3-RC3, created on 2011-02-20 00:34:18
         compiled from "/media/WorkFlash/Projekty/MultimediaLibrary/config/../smarty/CZ/templates/signin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12100502804d60537ae1d888-38064098%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04aee26202b9ed1f8f334439275c7b6fc9d728c3' => 
    array (
      0 => '/media/WorkFlash/Projekty/MultimediaLibrary/config/../smarty/CZ/templates/signin.tpl',
      1 => 1298158446,
    ),
  ),
  'nocache_hash' => '12100502804d60537ae1d888-38064098',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1>Přihlášení do systému</h1>
<form action="/user/signin" mthod="post">
    Login: <input type="text" name="user[username]" /><br />
    Heslo: <input type="password" name="user[password]" />
    <input type="submit" value="Přihlásit" />
</form>