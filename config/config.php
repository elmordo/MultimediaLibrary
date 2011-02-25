<?php
//nastaveni databazovych kosntant
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "multimedia");
define("DB_ADAPTER", "PDO_MYSQL");

//format timestamp databaze
define("DB_TIMESTAMP", "Y-m-d H:i:s");

//definice cest
define("PATH_APP_ROOT", __DIR__."/../");
define("PATH_LIB", PATH_APP_ROOT."libs/");
define("PATH_CONTENTS", PATH_APP_ROOT."contents/");

//nasaveni jazyka
define("LANGUAGE", "CZ");

//nastaveni data
date_default_timezone_set("Europe/Prague");

//definbice chybovych a ostatnich stavovych zprav
define("STATUS_404", "HTTP/1.1 404 Not Found");
define("STATUS_403", "HTTP/1.1 403 Forbidden");
define("STATUS_400", "HTTP/1.1 400 Bad Request");
define("STATUS_405", "HTTP/1.1 405 Method Not Allowed");
define("STATUS_409", "HTTP/1.1 409 Conflict");
define("STATUS_200", "HTTP/1.1 200 OK");

//spusteni inicializacniho skriptu
require_once __DIR__."/init.php";
?>