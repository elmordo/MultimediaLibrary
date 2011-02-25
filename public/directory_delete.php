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

//pokud nema uzivatel opravneni cist, pripoji se chybove hlaseni
if (!$permisions->write) {
    header(STATUS_403);
    include __DIR__."/errors/403.html";
    return;
}

//kontrola jestli je adresar prazdny
$subDirs = $directory->findDependentRowset($tableDirectories);

if ($subDirs->count()) {
    header(STATUS_405);
    include __DIR__."/errors/405.html";
    return;
}

$subFiles = $directory->findDependentRowset("Model_DocumentsDirectoriesHasManyDocuments");

if ($subFiles->count()) {
    header(STATUS_405);
    include __DIR__."/errors/405.html";
    return;
}

$directory->delete();

header(STATUS_200);
include __DIR__."/errors/200.html";
?>