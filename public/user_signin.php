<?php
//deklarace promenne pro preskoceni kontroly prihlaseni a anulaci cookie
$needLoginCheck = true;
unset($_COOKIE["_mlc"]);

//pripojeni kofigu
require_once __DIR__."/../config/config.php";

if (!isset($_REQUEST["user"]["username"])) {
    $_smarty->display("header.tpl");
    $_smarty->display("signin.tpl");
    $_smarty->display("footer.tpl");

    exit();
}

//pokus o prihlaseni uzivatele
$tableUsers = new Model_Users();

$user = $tableUsers->fetchRow($tableUsers->select(false)
        ->where("username like ?", $_REQUEST["user"]["username"]));

if (!$user) {
    $_smarty->display("header.tpl");
    $_smarty->display("signin.tpl");
    $_smarty->display("footer.tpl");

    exit();
}

//kontrola hesla
$hashPsw = sha1($_REQUEST["user"]["password"].$user->salt);

if (strcmp($hashPsw, $user->password)) {
    $_smarty->display("header.tpl");
    $_smarty->display("signin.tpl");
    $_smarty->display("footer.tpl");

    exit();
}

//vygenerovani cookie
$seed = time();

do {
    $cookie = sha1($seed.$user->username.$user->salt);

    $anotherUser = $tableUsers->fetchRow($tableUsers->select(false)
            ->where("cookie like ?", $cookie));
} while ($anotherUser);

//zapsani cookie
setcookie("_mlc", $cookie, 0, "/");
setcookie("testcookie", "6,=66;/", 666);

$user->cookie = $cookie;
$user->save();

//presmerovani na domovsky adresar
$tableDirecotory = new Model_DocumentsDirectories();

$root = $tableDirecotory->find($user->root_directory_id)
        ->current();

header(STATUS_200);
include __DIR__."/errors/200.html";
?>
