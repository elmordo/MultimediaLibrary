{php}
//informace o dokumentu
$document = $smarty->getTemplateVars("document");
$documentArr = $document->toArray();

//informace o hlavnim dokumentu
$master = $smarty->getTemplateVars("master");
$masterArr = $document->toArray();

//zapis adresaru
$directories = $smarty->getTemplateVars("directories");
$directoriesArr = $directories->toArray();

//zapis historie
$histories = $smarty->getTEmplateVars("histories");
$historiesArr = array();

foreach ($histories as $history) {
    $history = $history->toArray();
    unset($history["id"]);

    $historiesArr[] = $history;
}

//zapis vysledku
$response = array(
    "document" => $documentArr,
    "master" => $masterArr,
    "directory" => $directoriesArr,
    "history" => $historiesArr
);

echo Zend_Json::encode($response);
{/php}