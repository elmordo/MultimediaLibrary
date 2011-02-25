<?php
//pripojeni kofigu
require_once __DIR__."/../config/config.php";

//nacteni dokumentu
$tableDocuments = new Model_Documents();

//vygenerovani selectu
$columns = array(
	"uuid",
	"document_name",
	"mime_type",
	"user_id",
	"group_id",
	"mask",
	"created_at",
	"is_latest",
	"size"
);

$select = $tableDocuments->select(false)
	->from($tableDocuments, $columns);

if (empty($_REQUEST["uuid"])) {
    $tableShortcuts = new Model_DocumentsShortcuts();

    $shortcut = $tableShortcuts->fetchRow($tableShortcuts->select(false)
	    ->where("shortcut like ?", $_REQUEST["shortcut"]));

    if ($shortcut)
	$document = $shortcut->findParentRow("Model_Documents", null, $select);
    else
	$document = false;
} else {
     $document = $tableDocuments->fetchRow($select->where("uuid like ?", $_REQUEST["uuid"]));
}

if (!$document) {
    header(STATUS_404);
    include __DIR__."/errors/404.html";
    die();
}

//nacteni opravneni
$permisions = $document->getPermisions(Zend_Registry::get("user")->id, Zend_Registry::get("groups"));

//nacteni zaznamu z historie
$thisHistoryAssoc = $document->findDependentRowset("Model_DocumentsHistory", "new")->current();

if (!$thisHistoryAssoc)
    $thisHistoryAssoc = $document->findDependentRowset("Model_DocumentsHistory", "old")->current();

if ($thisHistoryAssoc->document_last_uuid == $document->uuid) {
    //pokud je aktualne nacteni dokument zaroven akutalni revizi, nacte se historie okamzine
    $histories = $document->findDependentRowset("Model_DocumentsHistory", "last");
    $master = $document;
} else {
    //pokud neni aktualne nacteny dokument zaroven aktualni revizi, nactese aktualni revize a z ni potom historie
    $master = $thisHistoryAssoc->findParentRow($tableDocuments, "last");
    
    $histories = $master->findDependentRowset("Model_DocumentsHistory", "last");
}

//nacteni adresaru ve kterych je dokument ulozen
$directories = $master->findManyToManyRowset("Model_DocumentsDirectories", "Model_DocumentsDirectoriesHasManyDocuments");

//vyhodnoceni formatu
$_REQUEST["format"] = strtolower($_REQUEST["format"]);

switch ($_REQUEST["format"]) {
    case "json":
        $format = "Json";
        break;

    default:
	$format = "Html";
}

$_smarty->assign("document", $document);
$_smarty->assign("master", $master);
$_smarty->assign("directories", $directories);
$_smarty->assign("histories", $histories);
$_smarty->assign("permisions", $permisions);
$_smarty->assign("user", Zend_Registry::get("user"));

$_smarty->display("documentGet$format.tpl");
?>
