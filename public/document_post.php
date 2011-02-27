<?php

//pripojeni kofigu
require_once __DIR__ . "/../config/config.php";

//kontrola jestli je soubor odeslan v promenne nebo jako multipart
if (isset($_FILES["document"])) {
    if (!is_uploaded_file($_FILES["document"]["tmp_name"]["content"])) {
        header(STATUS_400);
        include __DIR__ . "/errors/400.html";
    }

    //kontrola jestli se ma vzit jmeno dokumentu z jmena souboru
    if (!isset($_REQUEST["document"]["document_name"]))
        $_REQUEST["document"]["document_name"] = $_FILES["document"]["name"]["content"];

    //kontrola jeslti byl rucne nastaven MIME typ
    if (!isset($_REQUEST["document"]["mime_type"]))
        $_REQUEST["document"]["mime_type"] = $_FILES["document"]["type"]["content"];

    //zapsan velikosti z informaci o uploadovanem souboru
    $_REQUEST["document"]["size"] = $_FILES["document"]["size"]["content"];
} else {
    //zapsani velikosti
    $_REQUEST["document"]["size"] = strlen($document["content"]);
}

//kontrola jeslti jsou vsechny informce na svem miste
if (!isset($_REQUEST["document"]["document_name"])) {
    header(STATUS_400);
    include __DIR__ . "/errors/400.html";
    exit();
}

if (!isset($_REQUEST["document"]["content"]) && !isset($_FILES["document"])) {
    header(STATUS_400);
    include __DIR__ . "/errors/400.html";
    exit();
}

$document = $_REQUEST["document"];

//pokud neni nastaven mime typ, odhadne se podle pripony
if (!isset($document["mime_type"])) {
    $fileInfo = pathinfo($document["document_name"]);

    //pripojeni seznamu mime
    require_once __DIR__ . "/../config/mimes.inc";

    $document["mime_type"] = isset($mime_types[$fileInfo["extension"]]) ? $mime_types[$fileInfo["extension"]] : "application/octet-stream";
}

//nastaveni uzivatele
$document["user_id"] = Zend_Registry::get("user")->id;

//vytvoreni instance tabulky dokumentu
$tableDocuments = new Model_Documents();

//ulozeni do databaze
$row = $tableDocuments->createRow($document);
$row->save();

//zjisteni UUID aktualniho a prvniho dokumentu
$lastUuid = $row->uuid;
$firstUuid = $row->findFirstDocument()->uuid;

//ulozeni obsahu do souboru
if (isset($document["content"]))
    file_put_contents(PATH_CONTENTS . $firstUuid, $document["content"]);
else
    move_uploaded_file($_FILES["document"]["tmp_name"]["content"], PATH_CONTENTS . $firstUuid);

//vytvoreni linku se jmenem aktualni revize na prvni revizi
symlink(PATH_CONTENTS . $firstUuid, PATH_CONTENTS . $lastUuid);

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
include __DIR__ . "/errors/200.html";
?>
