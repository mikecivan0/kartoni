<?php
class Karton extends SQL{
	
	public $id;
	public $osoba_id;
	public $upis;
	public $lDijagnoza;
	public $fDijagnoza;
	public $pDijagnoza;
	public $vazniPodaci;
	public $ciljevi;
	public $plan;
	public $potpis;
	public $zabiljeske;
	public $zakljucak;
	public $prvaTh;
	public $zadnjaTh;
	public $nalaz_id;
	
	function __construct(){		
		$this->id = '';
		$this->osoba_id = '';
		$this->upis = '';
		$this->lDijagnoza = '';
		$this->fDijagnoza = '';
		$this->pDijagnoza = '';
		$this->vazniPodaci = '';
		$this->ciljevi = '';
		$this->plan = '';
		$this->potpis = null;
		$this->zabiljeske = '';
		$this->zakljucak = '';
		$this->prvaTh = null;
		$this->zadnjaTh = null;
		$this->nalaz_id = null;
	}
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function setOsobaId($osoba_id){
		$this->osoba_id = $osoba_id;
	}
	
	public function setUpis($upis){
		$this->upis = $upis;
	}
	
	public function setLDg($lDijagnoza){
		$this->lDijagnoza = trim($lDijagnoza);
	}
	
	public function setFDg($fDijagnoza){
		$this->fDijagnoza = trim($fDijagnoza);
	}
	
	public function setPDg($pDijagnoza){
		$this->pDijagnoza = trim($pDijagnoza);
	}
	
	public function setVazniPodaci($vazniPodaci){
		$this->vazniPodaci = trim($vazniPodaci);
	}
	
	public function setCiljevi($ciljevi){
		$this->ciljevi = trim($ciljevi);
	}
	
	public function setPlan($plan){
		$this->plan = trim($plan);
	}
	
	public function setZabiljeske($zabiljeske){
		$this->zabiljeske = trim($zabiljeske);
	}
	
	public function setZakljucak($zakljucak){
		$this->zakljucak = trim($zakljucak);
	}
	
	public function setPrvaTh($prvaTh){
		$this->prvaTh = $prvaTh;
	}
	
	public function setZadnjaTh($zadnjaTh){
		$this->zadnjaTh = $zadnjaTh;
	}
	
	public function setNalazId($nalaz_id){
		$this->nalaz_id = $nalaz_id;
	}
	
	public function noviKarton(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;	
		$osoba_id = $this->osoba_id;
		
		//unos kartona
		$izraz2 = $veza->prepare("insert into kartoni_kartoni(osoba_id) values(:osoba_id);");
		$izraz2->bindParam(":osoba_id", $osoba_id);
		$izraz2->execute();
		
		$this->setId($veza->lastInsertId());
	}

	public function kopiraj(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$id = $this->id;
		
		//traženje podataka kartona za kopiranje
		$izraz = $veza->prepare("select * from kartoni_kartoni where id=:id;");
		$izraz->bindParam(":id", $id);
		$izraz->execute();		
		$karton = $izraz->fetch(PDO::FETCH_OBJ);
		
		//unos novog kartona sa podacima starog 
		$izraz2 = $veza->prepare("insert into kartoni_kartoni(osoba_id,lDijagnoza,fDijagnoza,vazniPodaci,ciljevi,plan,potpis) 
										       values(:osoba_id,:lDijagnoza,:fDijagnoza,:vazniPodaci,:ciljevi,:plan,:potpis);");
		$izraz2->bindParam(":osoba_id", $karton->osoba_id);
		$izraz2->bindParam(":lDijagnoza", $karton->lDijagnoza);
		$izraz2->bindParam(":fDijagnoza", $karton->fDijagnoza);
		$izraz2->bindParam(":vazniPodaci", $karton->vazniPodaci);
		$izraz2->bindParam(":ciljevi", $karton->ciljevi);
		$izraz2->bindParam(":plan", $karton->plan);
		$izraz2->bindParam(":potpis", $karton->potpis);
		$izraz2->execute();
		$this->setId($veza->lastInsertId());
	}
	
	public function findById(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$id = $this->id;
		
		//traženje podataka kartona
		$izraz = $veza->prepare("select * from kartoni_kartoni where id=:id;");
		$izraz->bindParam(":id", $id);
		$izraz->execute();		
		$karton = $izraz->fetch(PDO::FETCH_OBJ);
		
		$this->setOsobaId($karton->osoba_id);
		$this->setUpis($karton->upis);
		$this->setLDg($karton->lDijagnoza);
		$this->setFDg($karton->fDijagnoza);
		$this->setPDg($karton->pDijagnoza);
		$this->setVazniPodaci($karton->vazniPodaci);
		$this->setCiljevi($karton->ciljevi);
		$this->setPlan($karton->plan);
		$this->setZabiljeske($karton->zabiljeske);
		$this->setZakljucak($karton->zakljucak);
		
		$izraz = $veza->prepare("select datum from kartoni_terapije where karton_id=:karton_id order by datum asc limit 1;");		
		$izraz->bindParam(':karton_id', $karton->id);
		$izraz->execute();
		$prviDatum = $izraz->fetch(PDO::FETCH_OBJ);
		$pravaTh = (empty($prviDatum)) ? "nema upisanih terapija" : $prviDatum->datum;
		$this->setPrvaTh($pravaTh);
			
		$izraz = $veza->prepare("select datum from kartoni_terapije where karton_id=:karton_id order by datum desc limit 1;");		
		$izraz->bindParam(':karton_id', $karton->id);
		$izraz->execute();
		$zadnjiDatum = $izraz->fetch(PDO::FETCH_OBJ);
		$zadnjaTh = (empty($zadnjiDatum)||$prviDatum->datum==$zadnjiDatum->datum) ? "nema upisanih terapija" : $zadnjiDatum->datum;
		$this->setZadnjaTh($zadnjaTh);
		
	}
	
	public function findByTerm($term){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//traženje podataka kartona					
		$izraz = $veza->prepare("select distinct k.*,o.ime,o.prezime,o.godiste,o.mbo from kartoni_kartoni k inner join kartoni_osobe o on k.osoba_id=o.id
								 left join kartoni_terapije t on t.karton_id=k.id
								 where concat(o.ime,' ',o.prezime) like :uvjet or concat(o.prezime,' ',o.ime) like :uvjet
								 or k.upis like :uvjet order by o.prezime, o.ime, length(k.upis), k.upis limit 50;");
		
		$uv="%" . mb_strtolower($term,'UTF-8') . "%";
		$izraz->bindParam(':uvjet', $uv);
		$izraz->execute();
		$kartoni = $izraz->fetchAll(PDO::FETCH_OBJ);
		
		$niz = array();
		foreach ($kartoni as $karton) {
			$izraz = $veza->prepare("select datum from kartoni_terapije where karton_id=:karton_id order by datum asc limit 1;");		
			$izraz->bindParam(':karton_id', $karton->id);
			$izraz->execute();
			$prviDatum = $izraz->fetch(PDO::FETCH_ASSOC);
			$karton->prvaTh = $prviDatum;
			array_push($niz,$karton);			
		}
		return json_encode($niz);
	}
	
	public function findByPId(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$osoba_id = $this->osoba_id;
		
		//traženje podataka kartona	po osoba_id				
		$izraz = $veza->prepare("select * from kartoni_kartoni where osoba_id=:osoba_id");		
		$izraz->bindParam(':osoba_id', $osoba_id);
		$izraz->execute();
		$kartoni = $izraz->fetchAll(PDO::FETCH_OBJ);

		$niz = array();
		foreach ($kartoni as $karton) {
			$upis = (strlen($karton->upis)==0) ? "prazan broj upisa" : $karton->upis;
			$this->setUpis($upis);
			
			$izraz = $veza->prepare("select datum from kartoni_terapije where karton_id=:karton_id order by datum asc limit 1;");		
			$izraz->bindParam(':karton_id', $karton->id);
			$izraz->execute();
			$prviDatum = $izraz->fetch(PDO::FETCH_OBJ);
			$karton->prvaTh = (empty($prviDatum)) ? "nema upisanih terapija" : $prviDatum->datum;
			
			$izraz = $veza->prepare("select datum from kartoni_terapije where karton_id=:karton_id order by datum desc limit 1;");		
			$izraz->bindParam(':karton_id', $karton->id);
			$izraz->execute();
			$zadnjiDatum = $izraz->fetch(PDO::FETCH_OBJ);
			$karton->zadnjaTh = (empty($zadnjiDatum)||$prviDatum->datum==$zadnjiDatum->datum) ? "nema upisanih terapija" : $zadnjiDatum->datum;
			
			array_push($niz,$karton);			
		}
		return $niz;
	}
	
	public function protokol($stranica,$redoslijed){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		
		$limit = 200;		
		$izraz = $veza->prepare("select * from kartoni_kartoni;");
		$izraz->execute();
		$ukupnoRezultata = $izraz->rowCount();
		$ukupnoStranica = ceil($ukupnoRezultata/$limit);
		$stranica = ($stranica>$ukupnoStranica) ? $ukupnoStranica : $stranica;
		$pocetno = ($stranica-1)*$limit;
		
		$sql = "select k.id as id,o.prezime, o.ime, o.godiste, k.upis from kartoni_kartoni k inner join kartoni_osobe o on k.osoba_id=o.id 
				 order by ";
		

		$sql .= ($redoslijed=="asc") ? "length(k.upis),k.upis" : "length(k.upis) desc,k.upis desc";
		$sql .= " limit $pocetno, $limit";

		$izraz = $veza->prepare($sql);
		$izraz->execute();
		
		$kartoni = $izraz->fetchAll(PDO::FETCH_OBJ);
				
		$niz = array();
		foreach ($kartoni as $karton) {
			$izraz = $veza->prepare("select datum from kartoni_terapije where karton_id=:karton_id order by datum asc limit 1;");		
			$izraz->bindParam(':karton_id', $karton->id);
			$izraz->execute();
			$prviDatum = $izraz->fetch(PDO::FETCH_OBJ);
			$karton->prvaTh = (empty($prviDatum)) ? "nema upisanih terapija" : $prviDatum->datum;
			
			$izraz = $veza->prepare("select datum from kartoni_terapije where karton_id=:karton_id order by datum desc limit 1;");		
			$izraz->bindParam(':karton_id', $karton->id);
			$izraz->execute();
			$zadnjiDatum = $izraz->fetch(PDO::FETCH_OBJ);
			$karton->zadnjaTh = (empty($zadnjiDatum)||$prviDatum->datum==$zadnjiDatum->datum) ? "nema upisanih terapija" : $zadnjiDatum->datum;
			
			$izraz = $veza->prepare("select count(datum) as ukupnoDana from kartoni_terapije where karton_id=:karton_id;");		
			$izraz->bindParam(':karton_id', $karton->id);
			$izraz->execute();
			$ukupnoDana = $izraz->fetch(PDO::FETCH_OBJ);
			$karton->ukupnoDana = (empty($ukupnoDana)) ? 0 : $ukupnoDana->ukupnoDana;
			
			array_push($niz,$karton);			
		}
		return array($niz,$ukupnoStranica);
	}
	
	public function findOtherCards($putanjaApp){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$id = $this->id;
		$osoba_id = $this->osoba_id;
		
		//traženje podataka kartona	po osoba_id				
		$izraz = $veza->prepare("select * from kartoni_kartoni where osoba_id=:osoba_id and id!=:id");		
		$izraz->bindParam(':osoba_id', $osoba_id);
		$izraz->bindParam(':id', $id);
		$izraz->execute();
		$kartoni = $izraz->fetchAll(PDO::FETCH_OBJ);
		
		$niz = array();
		foreach ($kartoni as $karton) {
			$izraz = $veza->prepare("select datum from kartoni_terapije where karton_id=:karton_id order by datum asc limit 1;");		
			$izraz->bindParam(':karton_id', $karton->id);
			$izraz->execute();
			$prviDatum = $izraz->fetch(PDO::FETCH_OBJ);
			$karton->prvaTh = (empty($prviDatum)) ? "nema upisanih terapija" : $prviDatum->datum;
			
			$izraz = $veza->prepare("select datum from kartoni_terapije where karton_id=:karton_id order by datum desc limit 1;");		
			$izraz->bindParam(':karton_id', $karton->id);
			$izraz->execute();
			$zadnjiDatum = $izraz->fetch(PDO::FETCH_OBJ);
			$karton->zadnjaTh = (empty($zadnjiDatum)||$zadnjiDatum->datum==$prviDatum->datum) ? "nema upisanih terapija" : $zadnjiDatum->datum;
			array_push($niz,$karton);			
		}
		
		if(!empty($niz)){
			$nazivSpola = ($_POST["spol"]==1) ? "pacijenta" : "pacijentice";
			echo "<h5>Ostali kartoni " . $nazivSpola . "</h5>";
			echo "<ol>";
				
			foreach ($niz as $drugiKarton) {
				$upis = (strlen($drugiKarton->upis)==0) ? "prazan broj upisa" : $drugiKarton->upis;
				$prvaTh = ($drugiKarton->prvaTh=="nema upisanih terapija") ? $drugiKarton->prvaTh : Alati::datum($drugiKarton->prvaTh);
				$zadnjaTh = ($drugiKarton->zadnjaTh=="nema upisanih terapija") ? "" : " - " . Alati::datum($drugiKarton->zadnjaTh);
				echo "<li>
						<a href='" . $putanjaApp . "kartoni/promjena.php?id=" . $drugiKarton->id . "&tab=ostaliPodaci'>
							Broj upisa: <b>" . $upis . "</b>, terapija provedena <b>" . $prvaTh . $zadnjaTh . "</b>
						</a>
					</li>";
			}
				
			echo "</ol><hr />";
					
		}			
	}
	
	public function update(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//update kartona
		$izraz = $veza->prepare("update kartoni_kartoni set upis=:upis, lDijagnoza=:lDijagnoza, fDijagnoza=:fDijagnoza, pDijagnoza=:pDijagnoza,
								 vazniPodaci=:vazniPodaci, ciljevi=:ciljevi, plan=:plan, zabiljeske=:zabiljeske, zakljucak=:zakljucak
								 where id=:id;");
		$izraz->bindParam(":upis", $_POST["upis"]);
		$izraz->bindParam(":lDijagnoza", $_POST["lDijagnoza"]);
		$izraz->bindParam(":fDijagnoza", $_POST["fDijagnoza"]);
		$izraz->bindParam(":pDijagnoza", $_POST["pDijagnoza"]);
		$izraz->bindParam(":vazniPodaci", $_POST["vazniPodaci"]);
		$izraz->bindParam(":ciljevi", $_POST["ciljevi"]);
		$izraz->bindParam(":plan", $_POST["plan"]);
		$izraz->bindParam(":zabiljeske", $_POST["zabiljeske"]);
		$izraz->bindParam(":zakljucak", $_POST["zakljucak"]);
		$izraz->bindParam(":id", $_POST["hfKartonId"]);
		$izraz->execute();		
	}

	public function delete(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//brisanje upisanih terapija
		$izraz = $veza->prepare("delete from kartoni_terapije where karton_id=:id;");
		$izraz->bindParam(":id", $_POST["kartonId"]);
		$izraz->execute();	
		
		//brisanje upisanih mjera
		$izraz = $veza->prepare("delete from kartoni_mjere where karton_id=:id;");
		$izraz->bindParam(":id", $_POST["kartonId"]);
		$izraz->execute();	
		
		//brisanje kartona
		$izraz = $veza->prepare("delete from kartoni_kartoni where id=:id;");
		$izraz->bindParam(":id", $_POST["kartonId"]);
		$izraz->execute();	
		return "Karton obrisan";			
	}
	
	public function novi(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//unos novog kartona
		$izraz = $veza->prepare("insert into kartoni_kartoni(osoba_id) values(:osoba_id);");
		$izraz->bindParam(":osoba_id", $_POST["osobaId"]);
		$izraz->execute();	
		
		return "Karton kreiran";			
	}
	
	public function osobaIdPremaDatumima($odDatuma,$doDatuma){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//izdvajanje osoba po zadanom intervalu dolazaka na terapije
		$izraz = $veza->prepare("select distinct osoba_id from kartoni_kartoni k inner join kartoni_terapije t on t.karton_id=k.id
								 where t.datum between :odDatuma and :doDatuma order by k.upis;");
		$izraz->bindParam(":odDatuma", $odDatuma);
		$izraz->bindParam(":doDatuma", $doDatuma);
		$izraz->execute();	
		
		return $izraz->fetchAll(PDO::FETCH_OBJ);
	}
	
	public function kreirajPremaNalazu($putanjaApp){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$osoba_id = $this->osoba_id;
		$nalaz_id = $this->nalaz_id;
		
		//dohvat podataka nalaza
		$izraz = $veza->prepare("select * from kartoni_nalazi where id=:id;");
		$izraz->bindParam(":id", $nalaz_id);
		$izraz->execute();	
		$nalaz = $izraz->fetch(PDO::FETCH_OBJ);
		
		//provjera postoji li osoba u bazi
		$izraz = $veza->prepare("select * from kartoni_osobe where id=:id;");
		$izraz->bindParam(":id", $osoba_id);
		$izraz->execute();	
		$osoba = $izraz->fetch(PDO::FETCH_OBJ);
		
		$datumPP = $this->hrDatum($_GET["prvaTh"]);
		if(!empty($osoba)){
			if(!empty($nalaz)){
				$pDijagnoza = $datumPP . " " . $nalaz->pDijagnoza;
				
				$izraz = $veza->prepare("insert into kartoni_kartoni(osoba_id,lDijagnoza,fDijagnoza,pDijagnoza,vazniPodaci,plan) 
										values(:osoba_id,:lDijagnoza,:fDijagnoza,:pDijagnoza,:vazniPodaci,:plan);");
				$izraz->bindParam(":osoba_id", $osoba_id);
				$izraz->bindParam(":lDijagnoza", $nalaz->lDijagnoza);
				$izraz->bindParam(":fDijagnoza", $nalaz->fDijagnoza);
				$izraz->bindParam(":pDijagnoza", $pDijagnoza);
				$izraz->bindParam(":vazniPodaci", $nalaz->vazniPodaci);
				$izraz->bindParam(":plan", $nalaz->plan);
				$izraz->execute();	
				
				$this->setId($veza->lastInsertId());
				return $this->id;
				
			}else{
				echo "Nema podataka traženog nalaza.";
			}
		}else{
			echo "Nema podata za traženu osobu.";
		}		
	}
		
	protected function hrDatum($str){
		$date = (empty($str)) ? null :  date("d.m.Y.", strtotime($str));
		return $date;
	}
			
}
