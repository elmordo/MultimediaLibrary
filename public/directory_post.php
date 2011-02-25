<?php
//pripojeni kofigu
require_once __DIR__."/../config/config.php";

//vytvoreni instance tabulky adresaru a nacteni adresare
$tableDirectories = new Model_DocumentsDirectories();

/**
 * @var Model_Row_Directory $directory
 */
$directory = $tableDirectories->find($_REQUEST["directory_id"])->current();

//kontrola existence adresare
if (!$directory) {
    header(STATUS_404);
    include __DIR__."/errors/404.html";
    return;
}

//kontrola opravneni pristupu
$user = Zend_Registry::get("user");
$groups = Zend_Registry::get("groups");

$permisions = $directory->getPermisions($user->id, $groups);

//pokud nema uzivatel opravneni cist, pripoji se chybove hlaseni
if (!$permisions->write) {
    header(STATUS_403);
    include __DIR__."/errors/403.html";
    return;
}

//kontrola jmena
if (!isset($_REQUEST["directory"]["directory_name"])) {
    header(STATUS_400);
    include __DIR__."/errors/400.html";
    return;
}

$_REQUEST["directory"]["directory_name"] = trim($_REQUEST["directory"]["directory_name"]);

if (empty($_REQUEST["directory"]["directory_name"])) {
    header(STATUS_400);
    include __DIR__."/errors/400.html";
    return;
}

$newDirectory = $tableDirectories->createRow();
$newDirectory->directory_name = $_REQUEST["directory"]["directory_name"];
$newDirectory->parent_id = $directory->id;
$newDirectory->user_id = $user->id;
$newDirectory->group_id = 0;
$newDirectory->depth = $directory->depth + 1;

$newDirectory->save();

header(STATUS_200);
include __DIR__."/errors/200.html";
?>