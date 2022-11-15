<?php
$db = new PDO('mysql:host=localhost;dbname=coldc2yn_ammaf;charset=utf8mb4', 'coldc2yn_ammaf', 'feathercode123');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>
