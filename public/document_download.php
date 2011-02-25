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

//kontrola opravneni
$permisions = $document->getPermisions(Zend_Registry::get("user")->id, Zend_Registry::get("groups"));

if (!$permisions->read) {
    header(STATUS_403);
    include __DIR__."/errors/403.html";
    return;
}

//nacteni obsahu dokumentu
$content = file_get_contents(PATH_CONTENTS.$document->uuid);

//odeslani hlavicek
header("Content-Type: ".$document->mime_type);
header("Content-Length: ".strlen($content));
header("Content-Transfer-Encoding: binary");
header("Content-Disposition: inline; filename=$document->document_name");

print $content;
?>