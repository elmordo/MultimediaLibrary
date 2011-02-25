<?php
//pripojeni kofigu
require_once __DIR__."/../config/config.php";

//kontrola jestli je soubor odeslan v promenne nebo jako multipart
if (isset($_FILES["document"])) {
    if (!is_uploaded_file($_FILES["document"]["tmp_name"]["content"])) {
	header(STATUS_400);
	include __DIR__."/errors/400.html";
    }

    //nacteni obsahu souboru
    $_REQUEST["document"]["content"] = file_get_contents($_FILES["document"]["tmp_name"]["content"]);

    //kontrola jestli se ma vzit jmeno dokumentu z jmena souboru
    if (!isset($_REQUEST["document"]["document_name"]))
	$_REQUEST["document"]["document_name"] = $_FILES["document"]["name"]["content"];

    //kontrola jeslti byl rucne nastaven MIME typ
    if (!isset($_REQUEST["document"]["mime_type"]))
	$_REQUEST["document"]["mime_type"] = $_FILES["document"]["type"]["content"];
}

//kontrola jeslti jsou vsechny informce na svem miste
if (!isset($_REQUEST["document"]["content"], $_REQUEST["document"]["document_name"])) {
    header(STATUS_400);
    include __DIR__."/errors/400.html";
    exit();
}

$document = $_REQUEST["document"];

//zapsani velikosti
$document["size"] = strlen($document["content"]);

//pokud neni nastaven mime typ, odhadne se podle pripony
if (!isset($document["mime_type"])) {
    $fileInfo = pathinfo($document["document_name"]);

    //pripojeni seznamu mime
    require_once __DIR__."/../config/mimes.inc";

    $document["mime_type"] = isset($mime_types[$fileInfo["extension"]])?$mime_types[$fileInfo["extension"]]:"application/octet-stream";
}

//nastaveni uzivatele
$document["user_id"] = Zend_Registry::get("user")->id;

//vytvoreni instance tabulky dokumentu
$tableDocuments = new Model_Documents();

//ulozeni do databaze
$row = $tableDocuments->createRow($document);
$row->save();

//ulozeni obsahu do souboru
file_put_contents(PATH_CONTENTS.$row->uuid, $document["content"]);

//pokud byl odeslan pozadavek na zarazeni do adresare, soubor se zaradi
if (isset($_REQUEST["directory"]["id"])) {
    $tableAssocs = new Model_DocumentsDirectoriesHasManyDocuments();
    $rowDir = $tableAssocs->createRow(array(
	"document_directory_id" => $_REQUEST["directory"]["id"],
	"document_uuid" => $row->uuid
    ));

    $rowDir->save();
}

header(STATUS_200);
include __DIR__."/errors/200.html";
?>
