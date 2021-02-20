<?php
include_once '../config/conf.php';

if (!$_POST) {
	header("location: prijava.php?error=4");
	//niste autorizirani za taj posao
} else {
	//ako nije upisano korisničko ime vrati ga natrag
	if (strlen(trim($_POST["username"])) < 1) {
		header("location: prijava.php?error=5");
		//upišite korisničko ime

	}

	//ako nije upisano korisničko ime vrati ga natrag
	if ($_POST["password"] == "") {
		header("location: prijava.php?error=3&username=" . $_POST["username"]);

	}

	include '../config/conf.php';

	//provjera podataka

	//da li korisničko ime uopće postoji u bazi
	$izraz = $veza -> prepare("select * from kartoni_users where username=:username");
	$izraz -> bindParam(':username', $_POST["username"]);
	$izraz -> execute();
	$korisnik = $izraz -> fetch(PDO::FETCH_OBJ);

	//ako korisnik postoji onda provjeri odgovar ali lozinka
	if (!empty($korisnik)) {

		if ($korisnik -> password == md5($_POST["password"])) {
			//ako odgovara lozinka poništi ako ima prethodnih grešaka u prijavi, stvori session 'autoriziran'
			//i preusmeri korisnika ovisno o razini
			if (isset($_SESSION[$ida . "attempt"])) {
				unset($_SESSION[$ida . "attempt"]);
			}
			$_SESSION[$ida . "autoriziran"] = $korisnik;
			
			if($korisnik->razina=='user'){
				header("location: " . $putanjaApp . "kartoni/index.php");
			}else{
				header("location: " . $putanjaApp . $korisnik->razina . "/index.php");
			}
			
		} else {
			header("location: prijava.php?error=6&username=" . $_POST["username"]);
			//netočna lozinka
		}
	} else {
		header("location: prijava.php?error=2&username=" . $_POST["username"]);
		//nepostojeći korisnik
	}
}
