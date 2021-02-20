<?php
class Pacijent extends SQL{
	
	public function find($id){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//traženje podataka pacijenta po id
		$izraz = $veza->prepare("select * from kartoni_osobe where id=:id;");
		$izraz->bindParam(":id", $id);
		$izraz->execute();		
		return $izraz->fetch(PDO::FETCH_OBJ);
	}
	
	public function uputnice($pacijent_id){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		$arrayUputnica = array();
		
		//traženje podataka pacijenta po id
		$izraz = $veza->prepare("select distinct datum from kartoni_uputnice where osoba_id=:id;");
		$izraz->bindParam(":id", $pacijent_id);
		$izraz->execute();		
		$uputnice = $izraz->fetchAll(PDO::FETCH_OBJ);
		
		foreach($uputnice as $uputnica){
			$datum = $this->hrDatum($uputnica->datum);
			array_push($arrayUputnica,$datum);
		}
		
		return implode(", ", $arrayUputnica);
	}
	
	public function findForList($id){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		
		$pacijent = $this->find($id);
		
		//traženje ima li uputnicu kod nas
		$izraz = $veza->prepare("select upis from kartoni_kartoni where osoba_id=:id limit 1;");
		$izraz->bindParam(":id", $id);
		$izraz->execute();	
		$ima = $izraz->fetch(PDO::FETCH_OBJ);
		
		$nastavno = (!empty($ima->upis)) ? true : false;
		
		$pacijent->nastavno = $nastavno;
		return $pacijent;
	}
	
	public function findByTerm($term){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//traženje podataka pacijenta po term				
		$izraz = $veza->prepare("select * from kartoni_osobe
								 where concat(ime,' ',prezime) like :uvjet or concat(prezime,' ',ime) like :uvjet
								 or mbo like :uvjet order by prezime, ime;");
		
		$uv="%" . mb_strtolower($term,'UTF-8') . "%";
		$izraz->bindParam(':uvjet', $uv);
		$izraz->execute();
		
		return json_encode($izraz->fetchAll(PDO::FETCH_OBJ));
	}
	
	public function pacijentiKojiNisuNaListiZaZvati($term){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//traženje podataka pacijenta koji nisu na listi za zvati
		$izraz = $veza->prepare("select * from kartoni_osobe
								 where (concat(ime,' ',prezime) like :uvjet or concat(prezime,' ',ime) like :uvjet)
								 and id not in(select osoba_id from kartoni_listaZaZvati) order by prezime, ime;");
		
		$uv="%" . mb_strtolower($term,'UTF-8') . "%";
		$izraz->bindParam(':uvjet', $uv);
		$izraz->execute();
		
		return json_encode($izraz->fetchAll(PDO::FETCH_OBJ));
	}
	
	public function update(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$ime = trim($_POST["ime"]);
		$prezime = trim($_POST["prezime"]);
		$zanimanje = trim($_POST["zanimanje"]);
		$telefon = trim($_POST["telefon"]);
		$mbo = trim($_POST["mbo"]);
		$dopunsko = trim($_POST["dopunsko"]);
		
		//update osobe
		$izraz = $veza->prepare("update kartoni_osobe set ime=:ime, prezime=:prezime, zanimanje=:zanimanje, spol=:spol, godiste=:godiste,
								 telefon=:telefon, mbo=:mbo, dopunsko=:dopunsko where id=:id;");
		$izraz->bindParam(":ime", $ime);
		$izraz->bindParam(":prezime", $prezime);
		$izraz->bindParam(":zanimanje", $zanimanje);
		$izraz->bindParam(":spol", $_POST["spol"]);
		$izraz->bindParam(":godiste", $_POST["godiste"]);
		$izraz->bindParam(":telefon", $telefon);
		$izraz->bindParam(":mbo", $mbo);
		$izraz->bindParam(":dopunsko", $dopunsko);
		$izraz->bindParam(":id", $_POST["hfOsobaId"]);
		$izraz->execute();		
	}
	
	public function delete(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
	
		//brisanje osobe		
		$izraz = $veza->prepare("delete from kartoni_mjere where osoba_id=:id;");
		$izraz->bindParam(":id", $_POST["osobaId"]);
		$izraz->execute();	
		
		$izraz = $veza->prepare("delete from kartoni_osobe where id=:id;");
		$izraz->bindParam(":id", $_POST["osobaId"]);
		$izraz->execute();	
	}
	
	protected function hrDatum($str){
		$date = (empty($str)) ? null :  date("d.m.Y.", strtotime($str));
		return $date;
	}
}
