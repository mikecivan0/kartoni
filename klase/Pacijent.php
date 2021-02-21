<?php
class Pacijent extends SQL{
	
	public $id;
	public $ime;
	public $prezime;
	public $zanimanje;
	public $spol;
	public $godiste;
	public $telefon;
	public $mbo;
	public $dopunsko;
	public $poruka;
	public $nastavno;
	
	function __construct(){		
		$this->id = '';
		$this->ime = '';
		$this->prezime = '';
		$this->zanimanje = '';
		$this->spol = '';
		$this->godiste = '';		
		$this->telefon = '';
		$this->mbo = '';
		$this->dopunsko = '';
		$this->poruke = null;
		$this->nastavno = false;
	}
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function setIme($ime){
		$this->ime = $this->prvaVelikaSlova(trim($ime));
	}
	
	public function setPrezime($prezime){
		$this->prezime = $this->prvaVelikaSlova(trim($prezime));
	}
	
	public function setZanimanje($zanimanje){
		$this->zanimanje = $zanimanje;
	}
	
	public function setSpol($spol){
		$this->spol = $spol;
	}
	
	public function setGodiste($godiste){
		$this->godiste = trim($godiste);
	}
	
	public function setTelefon($telefon){
		$this->telefon = trim($telefon);
	}
	
	public function setMBO($mbo){
		$this->mbo = trim($mbo);
	}
	
	public function setDopunsko($dopunsko){
		$this->dopunsko = trim($dopunsko);
	}

	
	private function setPoruke($poruke){
		$this->poruke = $poruke;
	}
	
	private function setNastavno($nastavno){
		$this->nastavno = $nastavno;
	}
	
	public function findById(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$id = $this->id;
		
		//traženje podataka pacijenta po id
		$izraz = $veza->prepare("select * from kartoni_osobe where id=:id;");
		$izraz->bindParam(":id", $id);
		$izraz->execute();		
		
		$pacijent = $izraz->fetch(PDO::FETCH_OBJ);
		
		$this->setIme($pacijent->ime);
		$this->setPrezime($pacijent->prezime);
		$this->setZanimanje($pacijent->zanimanje);
		$this->setSpol($pacijent->spol);
		$this->setGodiste($pacijent->godiste);
		$this->setTelefon($pacijent->telefon);
		$this->setMBO($pacijent->mbo);
		$this->setDopunsko($pacijent->dopunsko);
	}
	
	
	public function jeLiNastavno(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$osoba_id = $this->id;
		
		//traženje ima li uputnicu kod nas
		$izraz = $veza->prepare("select upis from kartoni_kartoni where osoba_id=:osoba_id limit 1;");
		$izraz->bindParam(":osoba_id", $osoba_id);
		$izraz->execute();	
		$ima = $izraz->fetch(PDO::FETCH_OBJ);
		
		$nastavno = (!empty($ima->upis)) ? true : false;
		
		$this->setNastavno($nastavno);
	}
	
	public function findByTerm($term){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//traženje podataka pacijenta po term				
		$izraz = $veza->prepare("select * from kartoni_osobe
								 where concat(ime,' ',prezime) like :uvjet or concat(prezime,' ',ime) like :uvjet
								 or mbo like :uvjet order by prezime, ime limit 50;");
		
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
								 and id not in(select osoba_id from kartoni_listaZaZvati) order by prezime, ime limit 50;");
		
		$uv="%" . mb_strtolower($term,'UTF-8') . "%";
		$izraz->bindParam(':uvjet', $uv);
		$izraz->execute();
		
		return json_encode($izraz->fetchAll(PDO::FETCH_OBJ));
	}
	
	public function provjeraPrijeUnosaNovog(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		$mbo = $this->mbo;
		
		$greske = $this->generalnaProvjera();
		
		if(empty($greske)){
			$izraz = $veza->prepare("select * from kartoni_osobe where mbo=:mbo;");
			$izraz->bindParam(":mbo", $mbo);
			$izraz->execute();		
			$imaMbo = $izraz->fetch(PDO::FETCH_OBJ);
			
			if(!empty($imaMbo)){
				$g=new stdClass();
				$g->element="mbo";
				$g->poruka="Pacijent sa tim MBO-em već postoji u bazi";
				array_push($greske,$g);
			}
		}		
		
		return $greske;
	}
	
	public function provjeraPrijePromjene(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		$id = $this->id;
		$mbo = $this->mbo;
		
		$greske = $this->generalnaProvjera();
		
		if(empty($greske)){
			$izraz = $veza->prepare("select * from kartoni_osobe where mbo=:mbo and id!=:id;");
			$izraz->bindParam(":mbo", $mbo);
			$izraz->bindParam(":id", $id);
			$izraz->execute();		
			$imaMbo = $izraz->fetch(PDO::FETCH_OBJ);
			
			if(!empty($imaMbo)){
				$g=new stdClass();
				$g->element="mbo";
				$g->poruka="Pacijent sa tim MBO-em već postoji u bazi";
				array_push($greske,$g);
			}
		}
		
		
		return $greske;
	}
	
	public function generalnaProvjera(){
		
		$greske = array();
		
		if (strlen($this->ime)==0) {
			$g=new stdClass();
			$g->element="ime";
			$g->poruka="Obavezno ime";
			array_push($greske,$g);
		}
		
		if (strlen($this->prezime)==0) {
			$g=new stdClass();
			$g->element="prezime";
			$g->poruka="Obavezno prezime";
			array_push($greske,$g);
		}
		
		if (strlen($this->mbo)==0) {
			$g=new stdClass();
			$g->element="mbo";
			$g->poruka="Obavezno MBO";
			array_push($greske,$g);
		}
		
		if (strlen($this->godiste)==0) {
			$g=new stdClass();
			$g->element="godiste";
			$g->poruka="Obavezno godište";
			array_push($greske,$g);
		}
		
		return $greske;
	}
	/*
	public function provjeraPrijeBrisanja(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;			
		$id = $this->id;
		
		$izraz = $veza->prepare("select * from nalozi where pacijent_id=:pacijent_id;");
		$izraz->bindParam(":pacijent_id", $id);
		$izraz->execute();		
		$imaNaloga = $izraz->fetchAll(PDO::FETCH_OBJ);			
		
		if(!empty($imaNaloga)){
			$poruke = "Pacijenta se ne može obrisati jer su mu pridruženi nalozi. Izbrišite prvo naloge vezane za pacijenta.";
		}else{
			$poruke = null;
		}
		
		$this->setPoruke($poruke);
	}
	*/
	public function noviPacijent(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$ime = $this->ime;
		$prezime = $this->prezime;
		$zanimanje = $this->zanimanje;
		$spol = $this->spol;
		$godiste = $this->godiste;
		$telefon = $this->telefon;
		$mbo = $this->mbo;
		$dopunsko = $this->dopunsko;
		
		//update pacijenta
		$izraz = $veza->prepare("insert into kartoni_osobe(ime,prezime,spol,godiste,zanimanje,telefon,mbo,dopunsko)
											values(:ime,:prezime,:spol,:godiste,:zanimanje,:telefon,:mbo,:dopunsko);");
		$izraz->bindParam(":ime", $ime);
		$izraz->bindParam(":prezime", $prezime);
		$izraz->bindParam(":zanimanje", $zanimanje);
		$izraz->bindParam(":spol", $spol);
		$izraz->bindParam(":godiste", $godiste);
		$izraz->bindParam(":telefon", $telefon);
		$izraz->bindParam(":mbo", $mbo);
		$izraz->bindParam(":dopunsko", $dopunsko);
		$izraz->execute();		
		
		$this->setId($veza->lastInsertId());
	}
	
	public function update(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$id = $this->id;
		$ime = $this->ime;
		$prezime = $this->prezime;
		$zanimanje = $this->zanimanje;
		$spol = $this->spol;
		$godiste = $this->godiste;
		$telefon = $this->telefon;
		$mbo = $this->mbo;
		$dopunsko = $this->dopunsko;
		
		//update osobe
		$izraz = $veza->prepare("update kartoni_osobe set ime=:ime,prezime=:prezime,zanimanje=:zanimanje,spol=:spol,godiste=:godiste,
								 telefon=:telefon,mbo=:mbo,dopunsko=:dopunsko where id=:id;");
		$izraz->bindParam(":ime", $ime);
		$izraz->bindParam(":prezime", $prezime);
		$izraz->bindParam(":zanimanje", $zanimanje);
		$izraz->bindParam(":spol", $spol);
		$izraz->bindParam(":godiste", $godiste);
		$izraz->bindParam(":telefon", $telefon);
		$izraz->bindParam(":mbo", $mbo);
		$izraz->bindParam(":dopunsko", $dopunsko);
		$izraz->bindParam(":id", $id);
		$izraz->execute();		
	}
	
	public function delete(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$id = $this->id;
		
		//brisanje osobe		
		$izraz = $veza->prepare("delete from kartoni_mjere where osoba_id=:id;");
		$izraz->bindParam(":id", $id);
		$izraz->execute();	
		
		$izraz = $veza->prepare("delete from kartoni_osobe where id=:id;");
		$izraz->bindParam(":id", $id);
		$izraz->execute();	
	}
	
	protected function hrDatum($str){
		$date = (empty($str)) ? null :  date("d.m.Y.", strtotime($str));
		return $date;
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
}
