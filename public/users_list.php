<?php
//pripojeni kofigu
require_once __DIR__."/../config/config.php";

//nacteni seznamu uzivatelu
$tableUsers = new Model_Users();

$select = $tableUsers->select(false)
	->from($tableUsers, array(
	    "id",
	    "username",
	    "email"
	));

if (isset($_REQUEST["users"]["order"])) {
    switch ($_REQUEST["users"]["order"]) {
	case "username":
	    $select->order("username");
	    break;

	case "id":
	    $select->order("id");
	    break;

	case "email":
	    $select->order("email");
	    break;
    }
}

//vyhledani uzivatlei
$users = $tableUsers->fetchAll($select);

//vyhodnoceni formatu
switch (strtolower($_REQUEST["format"])) {
    case "html":
	$format = "Html";
	break;

    case "json":
	$format = "Json";
	break;

    default:
	$format = "Html";
}

//vypsani vystupu
$_smarty->assign("users", $users);
$_smarty->display("/usersList$format.tpl");
?>
