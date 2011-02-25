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

//nacteni rodicovskeho adresare
$parentDir = $directory->findParentRow($tableDirectories);

//kontrola existence, pokud adresar neexistuje, zamitne se smazani adresare
if (!$parentDir) {
    header(STATUS_403);
    include __DIR__."/errors/403.html";
    return;
}

//kontrola opravneni pristupu
$user = Zend_Registry::get("user");
$groups = Zend_Registry::get("groups");

$permisions = $parentDir->getPermisions($user->id, $groups);

//pokud nema uzivatel opravneni zapisovat a uzivatel se snazi adresar prejmenovat, pripoji se chybove hlaseni
if (isset($_REQUEST["directory"]["directory_name"]) && !$permisions->write) {
    header(STATUS_403);
    include __DIR__."/errors/403.html";
    return;
}

//pokud chce uzivatel menit opravneni nebo skupinu, zkontroluje se, jeslti je majitelem souboru
if ((isset($_REQUEST["directory"]["mask"]) || isset($_REQUEST["directory"]["group_id"])) && $user->id != $directory->user_id) {
    header(STATUS_403);
    include __DIR__."/errors/403.html";
    return;
}

//zapsani zmen
if (isset($_REQUEST["directory"]["directory_name"]))
    $directory->directory_name = $_REQUEST["directory"]["directory_name"];

if (isset($_REQUEST["directory"]["group_id"])) {
    //kontrola jeslti skupina existuje
    $tableGroups = new Model_UsersGroups();
    $group = $tableGroups->find($_REQUEST["directory"]["group_id"])
	    ->current();

    if (!$group) {
	header(STATUS_400);
	include __DIR__."/errors/400.html";
	return;
    }

    $directory->group_id = $group->id;
}

if (isset($_REQUEST["directory"]["mask"])) {
    //kontorla validity masky
    $pattern = "^([r-]{1}[w-]{1}[x-]{1}){3}$";

    if (!ereg($pattern, $_REQUEST["directory"]["mask"])) {
	header(STATUS_400);
	include __DIR__."/errors/400.html";
	return;
    }

    $directory->mask = $_REQUEST["directory"]["mask"];
}

$directory->save();

header(STATUS_200);
include __DIR__."/errors/200.html";
?>