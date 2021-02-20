<?php
class Uputnica extends SQL{
	
	public $id;
	public $osoba_id;
	public $datum;
	public $noviDatum;
	
	function __construct(){		
		$this->id = '';
		$this->osoba_id = '';
		$this->datum = '';
		$this->noviDatum = '';
	}

	public function setId($id){
		$this->id = $id;
	}
	
	public function setOsobaId($osoba_id){
		$this->osoba_id = $osoba_id;
	}
	
	public function setDatum($datum){
		$this->datum = $datum;
	}
	
	public function setNoviDatum($noviDatum){
		$this->noviDatum = $noviDatum;
	}
	
	public function findByOId(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		$osoba_id = $this->osoba_id;
		$arrayUputnica = array();
		
		//traženje podataka nalaza	po osoba_id				
		$izraz = $veza->prepare("select distinct datum from kartoni_uputnice where osoba_id=:osoba_id order by datum");		
		$izraz->bindParam(':osoba_id', $osoba_id);
		$izraz->execute();
		$uputnice = $izraz->fetchAll(PDO::FETCH_OBJ);		

		foreach($uputnice as $uputnica){
			$datum = $this->hrDatum($uputnica->datum);
			$link = "<a href='../uputnice/index.php?osoba_id=" . $osoba_id . "&datum=" . $uputnica->datum . "' 
						style='color: black;'>" . $datum . "</a>";
			array_push($arrayUputnica,$link);
		}
		
		return implode(", ", $arrayUputnica);
	}			
	
	public function findByOIdAndDate(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		$osoba_id = $this->osoba_id;
		$datum = $this->datum;
		
		//traženje podataka nalaza	po osoba_id				
		$izraz = $veza->prepare("select distinct datum from kartoni_uputnice where osoba_id=:osoba_id and datum=:datum;");		
		$izraz->bindParam(':osoba_id', $osoba_id);
		$izraz->bindParam(':datum', $datum);
		$izraz->execute();
		$uputnica = $izraz->fetch(PDO::FETCH_OBJ);	
		
		if(!empty($uputnica)){
			$this->setDatum($uputnica->datum);
		}else{
			$this->setDatum("");
		}
		
	}		

	public function update(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		$osoba_id = $this->osoba_id;
		$datum = $this->datum;
		$noviDatum = $this->noviDatum;		

		$izraz = $veza->prepare("update kartoni_uputnice set datum=:noviDatum where osoba_id=:osoba_id and datum=:datum;");		
		$izraz->bindParam(':noviDatum', $noviDatum);
		$izraz->bindParam(':datum', $datum);
		$izraz->bindParam(':osoba_id', $osoba_id);
		$izraz->execute();	
		
	}	

	public function insert(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		$osoba_id = $this->osoba_id;
		$datum = $this->datum;

		$izraz = $veza->prepare("insert into kartoni_uputnice(osoba_id,datum) values(:osoba_id,:datum);");			
		$izraz->bindParam(':osoba_id', $osoba_id);
		$izraz->bindParam(':datum', $datum);
		$izraz->execute();	
		
	}	
	
	public function delete(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		$osoba_id= $this->osoba_id;
		$datum= $this->datum;
		
		//traženje podataka nalaza	po osoba_id				
		$izraz = $veza->prepare("delete from kartoni_uputnice where osoba_id=:osoba_id and datum=:datum;");		
		$izraz->bindParam(':osoba_id', $osoba_id);
		$izraz->bindParam(':datum', $datum);
		$izraz->execute();
		
	}	
	
	public function provjera(){
		
		$greske = array();
		
		if (strlen($this->datum)==0) {
			$g=new stdClass();
			$g->element="datum";
			$g->poruka="Obavezno datum";
			array_push($greske,$g);
		}
		
		return $greske;
	}
	
	public function provjeraPrijeIzmjene(){
		
		$greske = array();
		
		if (strlen($this->noviDatum)==0) {
			$g=new stdClass();
			$g->element="datum";
			$g->poruka="Obavezno datum";
			array_push($greske,$g);
		}
		
		return $greske;
	}
	
	protected function hrDatum($str){
		$date = (empty($str)) ? null :  date("d.m.Y.", strtotime($str));
		return $date;
	}
	
	protected function validateDate($date, $format = 'Y-m-d'){
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) === $date;
	}
}
