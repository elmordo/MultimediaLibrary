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
if (!$permisions->read) {
    header(STATUS_403);
    include __DIR__."/errors/403.html";
    return;
}

//nacteni obsahu adresare

//podrizene adresare
$subDirs = $directory->findDependentRowset($tableDirectories, null, $tableDirectories->select(false)
        ->order("directory_name"));

//podrizene soubory
$tableDocuments = new Model_Documents();

$files = $directory->findManyToManyRowset($tableDocuments, "Model_DocumentsDirectoriesHasManyDocuments", null, null, $tableDocuments->select(false)
        ->order("document_name"));

if (!isset($_REQUEST["format"]))
    $_REQUEST["format"] = "";

//kontorla formatu
switch (strtolower($_REQUEST["format"])) {
    case "json":
        $format = "Json";
        break;

    case "html":
        $format = "Html";
        break;

    default:
        $format = "Html";
}

//nacteni primeho rodice
$directParent = $directory->findParentRow($tableDirectories);

if (!$directParent)
    $directParent = $directory;

//nacteni plne cesty
$path = array();

$thisParent = $directParent;

if ($thisParent->id != $directory->id)
    $path[] = $thisParent;

while ($thisParent->depth) {
    $thisParent = $thisParent->findParentRow("Model_DocumentsDirectories");

    $path[] = $thisParent;
}

$path = array_reverse($path);

//zapsani informaci do smarty
$_smarty->assign("this", $directory);
$_smarty->assign("subdirs", $subDirs);
$_smarty->assign("files", $files);
$_smarty->assign("permisions", $permisions);
$_smarty->assign("directParent", $directParent);
$_smarty->assign("path", $path);

$_smarty->display("directoryGet$format.tpl");
?>
