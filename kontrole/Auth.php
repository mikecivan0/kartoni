<?php

class Auth {
	public static function isAuth($ida,$putanjaApp) {
		if(!isset($_SESSION[$ida . "autoriziran"])){
			header("location: " . $putanjaApp . "auth/prijava.php");
		}
	}
	
	public static function ifAuth($ida,$putanjaApp) {
		if(isset($_SESSION[$ida . "autoriziran"])){
			if($_SESSION[$ida . "autoriziran"]->razina=='user'){
				header("location: " . $putanjaApp . "kartoni/index.php");
			}else{
				header("location: " . $putanjaApp . $_SESSION[$ida . "autoriziran"]->razina . "/index.php");
			}
			
		}
	}
	
	public static function isDoctorOrRoot($ida,$putanjaApp) {
		if(!isset($_SESSION[$ida . "autoriziran"])||($_SESSION[$ida . "autoriziran"]->razina!='doctor'&&$_SESSION[$ida . "autoriziran"]->razina!='root')){
			session_destroy();
			header("location:" . $putanjaApp . "auth/prijava.php?error=4");
		}
	}
	
	public static function isRoot($ida,$putanjaApp) {
		if(!isset($_SESSION[$ida . "autoriziran"])||$_SESSION[$ida . "autoriziran"]->razina!='root'){
			session_destroy();
			header("location:" . $putanjaApp . "auth/prijava.php?error=4");
		}
	}
}
