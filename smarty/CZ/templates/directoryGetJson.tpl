{php}
//informace o adresari
$directoryArr = $smarty->getTemplateVars("this")->toArray();

//informace o podrazenych adresarich
$subdirsArr = $smarty->getTemplateVars("subdirs")->toArray();

//informace o podrazenych souborech
$filesArr = $smarty->getTemplateVars("files")->toArray();

//informace o ceste
$path = $smarty->getTemplateVars("path");
$pathArr = array();

foreach ($path as $segment)
    $pathArr[] = $segment->toArray();

$response = array(
    "directory" => $directoryArr,
    "subdirs" => $subdirsArr,
    "files" => $filesArr,
    "path" => $pathArr
);

echo Zend_Json::encode($response);
{/php}