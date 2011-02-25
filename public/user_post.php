<?php
//pripojeni kofigu
require_once __DIR__."/../config/config.php";

//kontorla jeslti je uzivatel ROOT
$user = Zend_Registry::get("user");

if ($user->id != 1) {
    header(STATUS_403);
    include __DIR__."/errors/403.html";
    return;
}

//kontorla odeslabych dat
if (!isset($_REQUEST["user"]["username"], $_REQUEST["user"]["password"], $_REQUEST["user"]["email"])) {
    header(STATUS_400);
    include __DIR__."/errors/400.html";
    return;
}

//kontorla existence uzivatele
$tableUsers = new Model_Users();

$userExists = $tableUsers->fetchRow($tableUsers->select(false)
	->where("username like ?", $_REQUEST["user"]["username"]));

if ($userExists) {
    header(STATUS_409);
    include __DIR__."/errors/409.html";
    return;
}

$newUser = $tableUsers->createRow();
$newUser->username = $_REQUEST["user"]["username"];
$newUser->email = $_REQUEST["user"]["email"];
$newUser->salt = sha1(time().$newUser->username.$newUser->email);
$newUser->password = sha1($_REQUEST["user"]["password"].$newUser->salt);

//ulozeni uzivatele kvuli vygebnerovani id
$newUser->save();

//vytvoreni korenoveho adresare uzivatele
$tableDirecotory = new Model_DocumentsDirectories();
$rootDir = $tableDirecotory->createRow();

$rootDir->directory_name = $newUser->username;
$rootDir->user_id = $newUser->id;
$rootDir->group_id = 0;
$rootDir->parent_id = 1;
$rootDir->depth = 1;
$rootDir->save();

//zapis id korenoveho adresare uzivatele
$newUser->root_directory_id = $rootDir->id;
$newUser->save();

header(STATUS_200);
include __DIR__."/errors/200.html";
?>
