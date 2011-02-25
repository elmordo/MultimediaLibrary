<?php
//pripojeni kofigu
require_once __DIR__."/../config/config.php";

//nacteni uzivatele z databaze
$tableUsers = new Model_Users();

if (isset($_REQUEST["user"]["username"]))
    $user = $tableUsers->fetchRow($tableUsers->select(false)
            ->where("username like ?", $_REQUEST["user"]["username"]));
else {
    if ($_REQUEST["user"]["id"] == 0)
	$_REQUEST["user"]["id"] = Zend_Registry::get("user")->id;

    $user = $tableUsers->find($_REQUEST["user"]["id"])
        ->current();
}

//kontrola nalezeni
if (!$user) {
    header(STATUS_404);
    include __DIR__."/errors/404.html";
    return;
}

//nacteni skupin a roli
$roles = $user->findManyToManyRowset("Model_UsersRoles", "Model_UsersHasManyUsersRoles");
$gorups = $user->findManyToManyRowset("Model_UsersGroups", "Model_UsersHasManyUsersGroups");

$_REQUEST["format"] = strtolower($_REQUEST["format"]);

switch ($_REQUEST["format"]) {
    case "json":
	header("Content-Type: application/json");
        $format = "Json";
        break;

    case "html":

    default:
        $format = "Html";
}

//zapsani dat a zobrazeni vysledku
$_smarty->assign("user", $user);
$_smarty->assign("roles", $roles);
$_smarty->assign("groups", $groups);

$_smarty->display("userGet$format.tpl");
?>
