<?php
//pripojeni kofigu
require_once __DIR__."/../config/config.php";

//nacteni uzivatele z databaze
$tableUsers = new Model_Users();
$user = $tableUsers->fetchRow($tableUsers->select(false)
	->where("username like ?", $_REQUEST["user"]["username"]));

if (!$user) {
    header(STATUS_404);
    include __DIR__."/errors/404.html";
    return;
}

//kontrola opravneni
$thisUser = Zend_Registry::get("user");

if ($user->id != $thisUser->id && $thisUser->id != 1) {
    header(STATUS_403);
    include __DIR__."/errors/403.html";
    return;
}

//update hodnot, ktere se maji zmenit
if (isset($_REQUEST["user"]["email"]))
    $user->email = $_REQUEST["user"]["email"];

if (isset($_REQUEST["user"]["password"]))
    $user->password = sha1($_REQUEST["user"]["password"].$user->salt);

$user->save();

header(STATUS_200);
include __DIR__."/errors/200.html";
?>