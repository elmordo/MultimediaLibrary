<?php
//pripojeni kofigu
require_once __DIR__."/../config/config.php";

//kontrola opravneni
if (Zend_Registry::get("user")->id != 1) {
    header(STATUS_405);
    include __DIR__."/errors/405.html";
    return;
}

//kontrola odeslanych dat
if (!isset($_REQUEST["user"]["username"])) {
    header(STATUS_400);
    include __DIR__."/errors/400.html";
    return;
}

//nacteni uzivatele z databaze
$tableUsers = new Model_Users();

$user = $tableUsers->fetchRow($tableUsers->select(false)
	->where("username like ?", $_REQUEST["user"]["username"]));

if (!$user) {
    header(STATUS_404);
    include __DIR__."/errors/404.html";
    return;
}

//odebrani asociaci na skupiny a role
$roles = $user->findDependentRowset("Model_UsersHasManyUsersRoles");

foreach ($roles as $role)
    $role->delete();

$groups = $user->findDependentRowset("Model_UsersHasManyUsersGroups");

foreach ($groups as $group)
    $group->delete();

//odebrani samotneho uzivatele
$user->delete();

header(STATUS_200);
include __DIR__."/errors/200.html";
?>
