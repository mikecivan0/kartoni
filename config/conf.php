<?php


$mysql_host = "localhost";
$mysql_database = "database";
$mysql_user = "user";
$mysql_password = "pass";
$putanjaApp = "/";
$title = '';
$bodyClass = '';
$headScript = '';
$footerScript = '';
$legend = '';
$formId = '';
$postURL = '';
$odgovor = '';
$greske = array();
$porukaOSpremanju = "";
$copyright = 2018;

$copyright .= ($copyright!=date("Y")) ? "-" . date("Y") : null;

 /*Identifikacija aplikacije */
$ida="kartoni_";

/*
 * Naslov aplikacije
 */
 $naslovAPP="Kartoni";
 



//spajanje na bazu
$veza = new PDO("mysql:dbname=" . $mysql_database . ";host=" . $mysql_host . "", $mysql_user, $mysql_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));



session_start();	

if(isset($_SESSION[$ida . "autoriziran"])){
	$podaci = $_SESSION[$ida . "autoriziran"];
	if($podaci->razina=='user' || $podaci->razina=='doctor'){
		$footerScript = '<script src="' . $putanjaApp . 'js/userF12.js"></script>';
	}
}

date_default_timezone_set('Europe/Zagreb');
