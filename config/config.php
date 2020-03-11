<?php
define('DS', DIRECTORY_SEPARATOR);
//define("ROOT_DIR", $_SERVER['DOCUMENT_ROOT'] . "/../");
define("ROOT_DIR", dirname(__DIR__));
define("CONTROLLER_NAMESPACE", "app\\controllers\\");
define("TEMPLATES_DIR", dirname(__DIR__) . "/views/");
define("PAGINATION_ITEM_COUNT", 3);