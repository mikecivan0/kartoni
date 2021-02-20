<?php
include_once '../config/conf.php';
include_once '../kontrole/Auth.php';
include_once '../klase/SQL.php';
include_once '../klase/Backup.php';

Auth::isAuth($ida, $putanjaApp);

$backup = new Backup();
$title = 'Backup';
$bodyClass = 'vjezbe';
$footerScript .= "<script>window.close();</script>";

include_once '../masters/masterHead.php';



$backup->backup_tables();


include_once '../masters/masterBottom.php';
?>

