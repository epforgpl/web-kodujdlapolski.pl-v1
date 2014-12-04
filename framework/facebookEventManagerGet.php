<?php

require_once('../../../../wp-config.php');
require_once('facebookEventManager.php');


$eventManager = new EventManager();

$eventManager->renewAccessToken(); //odswieza access token
$eventManager->clearEvents(); //usuwa wydarzenia, które już się odbyły
$eventManager->syncEvents(); //pobiera aktualne wydarzenia


?>