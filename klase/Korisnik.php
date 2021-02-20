<?php
class Korisnik extends SQL{
	
	public $id;
	public $username;
	public $password;
	public $passwordAgain;
	public $razina;
	
	function __construct(){		
		$this->id = '';
		$this->username = '';
		$this->password = '';
		$this->passwordAgain = '';
		$this->razina = '';
	}
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function setUsername($username){
		$this->username = $username;
	}
	
	public function setPassword($password){
		$this->password = $password;
	}
	
	public function setPasswordAgain($passwordAgain){
		$this->passwordAgain = $passwordAgain;
	}
	
	public function setRazina($razina){
		$this->razina = $razina;
	}
		
	public function findById(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$id = $this->id;
		
		//traženje podataka korisnika po id
		$izraz = $veza->prepare("select * from kartoni_users where id=:id;");
		$izraz->bindParam(":id", $id);
		$izraz->execute();		
		
		$korisnik = $izraz->fetch(PDO::FETCH_OBJ);
		
		if(!empty($korisnik)){
			$this->setUsername($korisnik->username);
			$this->setRazina($korisnik->razina);
		}
	}
	
	public function findAll(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$izraz = $veza->prepare("select * from kartoni_users;");
		$izraz->execute();		
		
		return $izraz->fetchAll(PDO::FETCH_OBJ);
	}

	public function provjeraPrijeUnosaNovog(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		$username = $this->username;
		$lozinkaOK = true;
		
		$greske = $this->generalnaProvjera();
		
		if(empty($greske)){
			$izraz = $veza->prepare("select * from kartoni_users where username=:username;");
			$izraz->bindParam(":username", $username);
			$izraz->execute();		
			$imaUser = $izraz->fetch(PDO::FETCH_OBJ);
			
			if(!empty($imaUser)){
				$g=new stdClass();
				$g->element="username";
				$g->poruka="Korisničko ime je zauzeto";
				array_push($greske,$g);
			}
			
			if(empty($this->password)){
				$g=new stdClass();
				$g->element="password";
				$g->poruka="Obavezno lozinka";
				array_push($greske,$g);
				$lozinkaOK = false;
			}
			
			if(empty($this->passwordAgain)){
				$g=new stdClass();
				$g->element="passwordAgain";
				$g->poruka="Obavezno ponovno lozinka";
				array_push($greske,$g);
				$lozinkaOK = false;
			}
			
			if($lozinkaOK==true){
				if($this->password != $this->passwordAgain){
					$g=new stdClass();
					$g->element="passwordAgain";
					$g->poruka="Loznike se ne podudaraju";
					array_push($greske,$g);
				}
			}
		}
		
		return $greske;
	}
	
	public function provjeraPrijePromjene(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		$id = $this->id;
		$username = $this->username;
		$loznikaOK = true;
		
		$greske = $this->generalnaProvjera();
		
		if(empty($greske)){
			$izraz = $veza->prepare("select * from kartoni_users where username=:username and id!=:id;");
			$izraz->bindParam(":username", $username);
			$izraz->bindParam(":id", $id);
			$izraz->execute();		
			$imaUser = $izraz->fetch(PDO::FETCH_OBJ);
			
			if(!empty($imaUser)){
				$g=new stdClass();
				$g->element="username";
				$g->poruka="Korisničko ime je zauzeto";
				array_push($greske,$g);
			}
			
			if(!empty($this->password) || !empty($this->passwordAgain)){
			
				if($this->password != $this->passwordAgain){
					$g=new stdClass();
					$g->element="password";
					$g->poruka="Loznike se ne podudaraju";
					array_push($greske,$g);
					
					$g=new stdClass();
					$g->element="passwordAgain";
					$g->poruka="Loznike se ne podudaraju";
					array_push($greske,$g);
				}
			}
		}		
		
		return $greske;
	}
	
	public function generalnaProvjera(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$greske = array();
		
		if (strlen($this->username)==0) {
			$g=new stdClass();
			$g->element="username";
			$g->poruka="Obavezno korisničko ime";
			array_push($greske,$g);
		}
		
		return $greske;
	}
	
	public function noviKorisnik(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$username = $this->username;
		$password = md5($this->password);
		$razina = $this->razina;
		
		//update pacijenta
		$izraz = $veza->prepare("insert into kartoni_users(username,password,razina)
											values(:username,:password,:razina);");
		$izraz->bindParam(":username", $username);
		$izraz->bindParam(":password", $password);
		$izraz->bindParam(":razina", $razina);
		$izraz->execute();		
		
	}
	
	public function update(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$id = $this->id;
		$username = $this->username;
		$password = $this->password;
		$razina = $this->razina;
		
		//update osobe
		if(strlen($password)==0){
			$izraz = $veza->prepare("update kartoni_users set username=:username,razina=:razina where id=:id;");
			$izraz->bindParam(":username", $username);
			$izraz->bindParam(":razina", $razina);
			$izraz->bindParam(":id", $id);
		}else{
			$password = md5($this->password);
			$izraz = $veza->prepare("update kartoni_users set username=:username,password=:password,razina=:razina where id=:id;");
			$izraz->bindParam(":username", $username);
			$izraz->bindParam(":password", $password);
			$izraz->bindParam(":razina", $razina);
			$izraz->bindParam(":id", $id);
		}
		
		$izraz->execute();		
	}
	
	public function delete(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$id = $this->id;
		
		//brisanje osobe		
		$izraz = $veza->prepare("delete from kartoni_users where id=:id;");
		$izraz->bindParam(":id", $id);
		$izraz->execute();	
	}

}
