{php}
//informace o uzivateli
$user = $smarty->getTemplateVars("user");

$userArr = array(
    "id" => $user->id,
    "username" => $user->username,
    "email" => $user->email,
    "root_directory_id" => $user->root_directory_id
);

//informace o rolich
$roles = $smarty->getTemplateVars("roles");
$roleArr = array();

foreach ($roles as $role) {
    $roleArr[] = array(
        "id" => $role->id,
        "role_name" => $role->role_name
    );
}

//informace o skupinach
$groups = $smarty->getTemplateVars("groups");
$groupArr = array();

foreach ($groups as $group) {
    $roleArr[] = array(
        "id" => $group->id,
        "group_name" => $group->group_name
    );
}

$response = array(
    "user" => $userArr,
    "group" => $groupArr,
    "role" => $roleArr
);

echo Zend_Json::encode($response);
{/php}