{php}
$users = $smarty->getTemplateVars("users");
$response = array("users" => $users->toArray());

echo Zend_Json::encode($response);
{/php}