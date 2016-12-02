<?php

require_once(dirname(__FILE__)."/models/database.php");
$link = db_connect();

require_once(dirname(__FILE__) . "/models/functions.php");
include(dirname(__FILE__) . "/views/main_page.php");

?>