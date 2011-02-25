<?php
ini_set("DisplayErrors", "On");

//nastaveni include path
set_include_path(PATH_LIB.PATH_SEPARATOR.get_include_path());

//pripojeni Zend_Loaderu a jeho nastaveni pro pouziti pro ZF
require_once 'Zend/Loader/Autoloader.php';

$loader = Zend_Loader_Autoloader::getInstance();
$loader->registerNamespace("Zend_");
$loader->registerNamespace("Model_");

//pripojeni smarty a jeho konfigurace
require_once 'Smarty/Smarty.class.php';

$_smarty = new Smarty();

//Obecna konfigurace smarty
$_smarty->caching = false;
$_smarty->compile_dir = PATH_APP_ROOT."smarty/".LANGUAGE."/templates_c";
$_smarty->template_dir = PATH_APP_ROOT."smarty/".LANGUAGE."/templates";
$_smarty->cache_dir = PATH_APP_ROOT."smarty/cache";
$_smarty->cache_lifetime = 0;
$_smarty->allow_php_tag = true;

Zend_Registry::set("_smarty", $_smarty);

//konfigurace adapteru a databaze
$_db = Zend_Db::factory(DB_ADAPTER, array(
        "host" => DB_HOST
        , "username" => DB_USER
        , "password" => DB_PASSWORD
        , "dbname" => DB_NAME
));

Zend_Db_Table_Abstract::setDefaultAdapter($_db);

if (isset($_COOKIE["_mlc"]) || isset($_REQUEST["_mlc"])) {
    $mlc = $_COOKIE["_mlc"].@$_REQUEST["_mlc"];

    //nacteni uzivatele podle cookie
    $tableUsers = new Model_Users();

    $user = $tableUsers->fetchRow($tableUsers->select(false)
            ->where("cookie like ?", $mlc));

    if ($user)
        $_smarty->assign("_user", $user->toArray());
    else {
        header(STATUS_403);
	include __DIR__."/../public/errors/403.hmtl";
        die();
    }
} elseif (isset($needLoginCheck)) {
    return;
} else {
    header(STATUS_403);
    include __DIR__."/../public/errors/403.html";
    die();
}

//zapis uzivatele do registru
Zend_Registry::set("user", $user);
$_smarty->assign("_user", $user);

//nalezeni skupin a jejich zapis do registru
$groups = $user->findDependentRowset("Model_UsersHasManyUsersGroups");
$groupsArr = array();

foreach ($groups as $group)
    $groupsArr[] = $group->user_group_id;

Zend_Registry::set("groups", $groupsArr);
?>
