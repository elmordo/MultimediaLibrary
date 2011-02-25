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
	"is_external",
	"size",
	"content"
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

if (!$document->is_latest) {
    header(STATUS_400);
    include __DIR__."/errors/400.html";
    die();
}

//nacteni opravneni
$permisions = $document->getPermisions(Zend_Registry::get("user")->id, Zend_Registry::get("groups"));

//update obecnych dat
$changed = false;

if (isset($_REQUEST["document"]["document_name"])) {
    $changed = true;

    if (!$permisions->write) {
	header(STATUS_404);
	include __DIR__."/errors/404.html";
	die();
    }

    $document->document_name = $_REQUEST["document"]["document_name"];
}

//kontrola zmeny masky opravneni
if (isset($_REQUEST["document"]["mask"])) {
    $changed = true;

    if ($document->user_id != Zend_Registry::get("user")->id) {
	header(STATUS_403);
	include __DIR__."/errors/403.html";
	die();
    }
    
    //kontorla validity masky
    $pattern = "^([r-]{1}[w-]{1}[x-]{1}){3}$";

    if (!ereg($pattern, $_REQUEST["document"]["mask"])) {
	header(STATUS_400);
	include __DIR__."/errors/400.html";
	return;
    }

    $document->mask = $_REQUEST["document"]["mask"];
}

//kontrola jeslti byl odeslan obsah v souboru
if (is_uploaded_file(@$_FILES["document"]["tmp_name"]["content"]))
    $_REQUEST["document"]["content"] = file_get_contents($_FILES["document"]["tmp_name"]["content"]);

//kontorla zmeny v obsahu souboru
if (isset($_REQUEST["document"]["content"])) {
    $changed = true;

    if (!$permisions->write) {
	header(STATUS_404);
	include __DIR__."/errors/404.html";
	die();
    }

    $document->content = $_REQUEST["document"]["content"];
}

//kontrola jestli je pozadavek na praci s adresarem
if (isset($_REQUEST["directory"]["id"], $_REQUEST["directory"]["method"])) {
    //nacteni adresare
    $tableDirectories = new Model_DocumentsDirectories();
    $directory = $tableDirectories->find($_REQUEST["directory"]["id"])
	    ->current();

    if (!$directory) {
	header(STATUS_400);
	include __DIR__."/errors/400.html";
	return;
    }

    //kontrola opravneni
    $dirPermisions = $directory->getPermisions(Zend_Registry::get("user")->id, Zend_Registry::get("groups"));

    if (!$dirPermisions->write) {
	header(STATUS_403);
	include __DIR__."/errors/403.html";
	return;
    }

    //nacteni informace o existujicim zaznamu o asociaci
    $dirAssoc = $directory->findDependentRowset("Model_DocumentsDirectoriesHasManyDocuments")->current();
}

//provedeni zmen
if ($changed)
    $document->save();

if (isset($directory)) {
    $tableDirAssocs = new Model_DocumentsDirectoriesHasManyDocuments();
    
    if ($_REQUEST["directory"]["method"] == "post" && !$dirAssoc) {
	$dirAssoc = $tableDirAssocs->createRow(array(
	    "document_directory_id" => $_REQUEST["directory"]["id"],
	    "document_uuid" => $document->uuid
	));

	$dirAssoc->save();
    } elseif ($_REQUEST["directory"]["method"] == "delete" && $dirAssoc) {
	$dirAssoc->delete();
        
        //kontorla jeslti je dokument jeste v nejakem adresari
        $dirList = $tableDirAssocs->fetchRow($tableDirAssocs->select(false)
                ->from($tableDirAssocs, array("num" => new Zend_Db_Expr("Count(*)")))
                ->where("document_uuid like ?", $document->uuid));

        //pokud dalsi asociace neexstiuje, presune se soubor do kose
        if (!$dirList->num) {
            $tableTrash = new Model_DocumentsUnassigned();
            $trashRow = $tableTrash->createRow(array(
                "uuid" => $document->uuid,
                "user_id" => $document->user_id,
                "document_name" => $document->document_name
            ));

            $trashRow->save();
        }
    }
}

header(STATUS_200);
include __DIR__."/errors/200.html";
?>
