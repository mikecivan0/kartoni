<?php
class Karton extends SQL{
	
	public $upis = null;
	public $prezime = null;
	public $ime = null;
	public $godiste = null;
	public $zanimanje = null;
	public $mbo = null;
	public $dopunsko = null;
	public $telefon = null;
	public $spol = null;
	
	public $osoba_id = null;
	public $kartonId = null;
	public $lDijagnoza = null;
	public $fDijagnoza = null;
	public $pDijagnoza = null;
	public $vazniPodaci = null;
	public $ciljevi = null;
	public $plan = null;
	public $potpis = null;
	public $zabiljeske = null;
	public $zakljucak = null;
	
	public $prvaTh = null;
	public $zadnjaTh = null;
	
	public function provjera(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$greske = array();
		
		if (strlen(trim($_POST["ime"]))==0) {
			$g=new stdClass();
			$g->element="ime";
			$g->poruka="Obavezno ime";
			array_push($greske,$g);
		}
		
		if (strlen(trim($_POST["prezime"]))==0) {
			$g=new stdClass();
			$g->element="prezime";
			$g->poruka="Obavezno prezime";
			array_push($greske,$g);
		}
		
		if (strlen(trim($_POST["mbo"]))==0) {
			$g=new stdClass();
			$g->element="mbo";
			$g->poruka="Obavezno MBO";
			array_push($greske,$g);
		}else{
			$izraz = $veza->prepare("select * from kartoni_osobe where mbo=:mbo;");
			$izraz->bindParam(":mbo", $_POST["mbo"]);
			$izraz->execute();		
			$imaMbo = $izraz->fetch(PDO::FETCH_OBJ);
			
			if(!empty($imaMbo)){
				$g=new stdClass();
				$g->element="mbo";
				$g->poruka="Osoba sa tim MBO-em već postoji u bazi";
				array_push($greske,$g);
			}
		}
		
		if (strlen(trim($_POST["godiste"]))==0) {
			$g=new stdClass();
			$g->element="godiste";
			$g->poruka="Obavezno godiste";
			array_push($greske,$g);
		}
		
		return $greske;
	}

	public function provjeraPrijePromjene(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$greske = array();
		
		if (strlen(trim($_POST["ime"]))==0) {
			$g=new stdClass();
			$g->element="ime";
			$g->poruka="Obavezno ime";
			array_push($greske,$g);
		}
		
		if (strlen(trim($_POST["prezime"]))==0) {
			$g=new stdClass();
			$g->element="prezime";
			$g->poruka="Obavezno prezime";
			array_push($greske,$g);
		}
		
		if (strlen(trim($_POST["mbo"]))==0) {
			$g=new stdClass();
			$g->element="mbo";
			$g->poruka="Obavezno MBO";
			array_push($greske,$g);
		}else{
			$izraz = $veza->prepare("select * from kartoni_osobe where mbo=:mbo and id!=:id;");
			$izraz->bindParam(":mbo", $_POST["mbo"]);
			$izraz->bindParam(":id", $_POST["hfOsobaId"]);
			$izraz->execute();		
			$imaMbo = $izraz->fetch(PDO::FETCH_OBJ);
			
			if(!empty($imaMbo)){
				$g=new stdClass();
				$g->element="mbo";
				$g->poruka="Osoba sa tim MBO-em već postoji u bazi";
				array_push($greske,$g);
			}
		}
		
		if (strlen(trim($_POST["godiste"]))==0) {
			$g=new stdClass();
			$g->element="godiste";
			$g->poruka="Obavezno godiste";
			array_push($greske,$g);
		}
		
		return $greske;
	}
	
	public function novaOsobaINoviKarton(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
				
		$ime = $this->prvaVelikaSlova($_POST["ime"]);
		$prezime = $this->prvaVelikaSlova($_POST["prezime"]);
		$zanimanje = trim($_POST["zanimanje"]);
		$telefon = trim($_POST["telefon"]);
		$mbo = trim($_POST["mbo"]);
		$dopunsko = trim($_POST["dopunsko"]);
		
		//unos kartoni_osobe
		$izraz = $veza->prepare("insert into kartoni_osobe(ime,prezime,zanimanje,spol,godiste,telefon,mbo,dopunsko)
											values(:ime,:prezime,:zanimanje,:spol,:godiste,:telefon,:mbo,:dopunsko);");
		$izraz->bindParam(":ime", $ime);
		$izraz->bindParam(":prezime", $prezime);
		$izraz->bindParam(":zanimanje", $zanimanje);
		$izraz->bindParam(":spol", $_POST["spol"]);
		$izraz->bindParam(":godiste", $_POST["godiste"]);
		$izraz->bindParam(":telefon", $telefon);
		$izraz->bindParam(":mbo", $mbo);
		$izraz->bindParam(":dopunsko", $dopunsko);
		$izraz->execute();
		
		$osobaId = $veza->lastInsertId();
		
		//unos kartona
		$izraz2 = $veza->prepare("insert into kartoni_kartoni(osoba_id) values(:osoba_id);");
		$izraz2->bindParam(":osoba_id", $osobaId);
		$izraz2->execute();
		$kartonId = $veza->lastInsertId();
		
	
		return $kartonId;
	}

	public function kopiraj(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//traženje podataka kartona za kopiranje
		$izraz = $veza->prepare("select * from kartoni_kartoni where id=:id;");
		$izraz->bindParam(":id", $_POST["kartonId"]);
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
		return $veza->lastInsertId();
	}
	
	public function find($id){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//traženje podataka kartona
		$izraz = $veza->prepare("select k.*,o.*,k.id as kartonId from kartoni_kartoni k inner join kartoni_osobe o on k.osoba_id=o.id
								 where k.id=:id;");
		$izraz->bindParam(":id", $id);
		$izraz->execute();		
		$karton = $izraz->fetch(PDO::FETCH_OBJ);
		$this->upis = $karton->upis;
		$this->prezime = $karton->prezime;
		$this->ime = $karton->ime;
		$this->godiste = $karton->godiste;
		$this->zanimanje = $karton->zanimanje;
		$this->mbo = $karton->mbo;
		$this->dopunsko = $karton->dopunsko;
		$this->telefon = $karton->telefon;
		$this->spol = $karton->spol;
		
		$this->osoba_id = $karton->osoba_id;
		$this->kartonId = $karton->kartonId;
		$this->lDijagnoza = $karton->lDijagnoza;
		$this->fDijagnoza = $karton->fDijagnoza;
		$this->pDijagnoza = $karton->pDijagnoza;
		$this->vazniPodaci = $karton->vazniPodaci;
		$this->ciljevi = $karton->ciljevi;
		$this->plan = $karton->plan;
		$this->potpis = $karton->potpis;
		$this->zabiljeske = $karton->zabiljeske;
		$this->zakljucak = $karton->zakljucak;
		
		$izraz = $veza->prepare("select datum from kartoni_terapije where karton_id=:karton_id order by datum asc limit 1;");		
		$izraz->bindParam(':karton_id', $karton->id);
		$izraz->execute();
		$prviDatum = $izraz->fetch(PDO::FETCH_OBJ);
		$this->prvaTh = (empty($prviDatum)) ? "nema upisanih terapija" : $prviDatum->datum;
			
		$izraz = $veza->prepare("select datum from kartoni_terapije where karton_id=:karton_id order by datum desc limit 1;");		
		$izraz->bindParam(':karton_id', $karton->id);
		$izraz->execute();
		$zadnjiDatum = $izraz->fetch(PDO::FETCH_OBJ);
		$this->zadnjaTh = (empty($zadnjiDatum)||$prviDatum->datum==$zadnjiDatum->datum) ? "nema upisanih terapija" : $zadnjiDatum->datum;
	}
	
	public function findByTerm($term){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//traženje podataka kartona					
		$izraz = $veza->prepare("select distinct k.*,o.ime,o.prezime,o.godiste,o.mbo from kartoni_kartoni k inner join kartoni_osobe o on k.osoba_id=o.id
								 left join terapije t on t.karton_id=k.id
								 where concat(o.ime,' ',o.prezime) like :uvjet or concat(o.prezime,' ',o.ime) like :uvjet
								 or k.upis like :uvjet order by o.prezime, o.ime, k.upis;");
		
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
	
	public function findByPId($id){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//traženje podataka kartona	po osoba_id				
		$izraz = $veza->prepare("select * from kartoni_kartoni where osoba_id=:id");		
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
		
		//traženje podataka kartona	po osoba_id				
		$izraz = $veza->prepare("select * from kartoni_kartoni where osoba_id=:pId and id!=:id");		
		$izraz->bindParam(':pId', $this->osoba_id);
		$izraz->bindParam(':id', $this->kartonId);
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
		
		$ime = $this->prvaVelikaSlova($_POST["ime"]);
		$prezime = $this->prvaVelikaSlova($_POST["prezime"]);
		$zanimanje = trim($_POST["zanimanje"]);
		$telefon = trim($_POST["telefon"]);
		$mbo = trim($_POST["mbo"]);
		$dopunsko = trim($_POST["dopunsko"]);
		
		//update kartoni_osobe
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
	
	public function kreirajPremaNalazu($putanjaApp,$osoba_id,$nalaz_id){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//dohvat podataka nalaza
		$izraz = $veza->prepare("select * from kartoni_nalazi where id=:id;");
		$izraz->bindParam(":id", $nalaz_id);
		$izraz->execute();	
		$nalaz = $izraz->fetch(PDO::FETCH_OBJ);
		
		//dohvat podataka kartoni_osobe
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
				
				return $veza->lastInsertId();
			}else{
				echo "Nema podataka traženog nalaza.";
			}
		}else{
			echo "Nema podata za traženu osobu.";
		}		
	}
	
	protected function mb_ucfirst($string, $encoding){
		$strlen = mb_strlen($string, $encoding);
		$firstChar = mb_substr($string, 0, 1, $encoding);
		$then = mb_substr($string, 1, $strlen - 1, $encoding);
		return mb_strtoupper($firstChar, $encoding) . $then;
	}
	
	protected function prvaVelikaSlova($rijec){
			$rijec = trim($rijec);
			$str = mb_strtolower($rijec);
			$expl = explode(" ",$str);
			$new = "";
			$arr = array();
			$arr2 = array();
			$final = "";

			foreach($expl as $key => $value){
				$val = $this->mb_ucfirst($value, "UTF-8");
				array_push($arr,ucfirst($val));
			}
			$new = implode(" ", $arr);

			$expl2 = explode("-",$new);

			foreach($expl2 as $key2 => $value2){
				$val2 = $this->mb_ucfirst($value2, "UTF-8");
				array_push($arr2,ucfirst($val2));
			}

			$final = implode("-", $arr2);

			return $final;
		}
		
	protected function hrDatum($str){
		$date = (empty($str)) ? null :  date("d.m.Y.", strtotime($str));
		return $date;
	}
			
}
