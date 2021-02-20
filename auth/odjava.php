<?php

include_once '../config/conf.php';

if($podaci){
	
$browser = (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') > 0) ? 'Firefox': 'Chrome';//odredi browser

$izraz = $veza -> prepare("insert into prijave(user_id,browser,datum,vrijeme,tip) values(:userId,:browser,CURDATE(),CURTIME(),0);");
$izraz -> bindParam(':userId', $podaci -> userId);
$izraz -> bindParam(':browser', $browser);
$izraz -> execute();
}
session_destroy();
header("location: ../auth/prijava.php");