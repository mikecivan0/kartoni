<?php
class Lista extends SQL{
	
	public $id;
	public $osoba_id;
	public $vrijeme;
	public $tip;
	public $nastavno;
	public $napomena;
	
	function __construct(){		
		$this->id = '';
		$this->osoba_id = '';
		$this->vrijeme = '';
		$this->tip = '';
		$this->nastavno = false;
		$this->napomena = '';	
	}
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function setOsobaId($osoba_id){
		$this->osoba_id = $osoba_id;
	}
	
	public function setVrijeme($vrijeme){
		$this->vrijeme = $vrijeme;
	}
	
	public function setTip($tip){
		$this->tip = $tip;
	}
	
	public function setNastavno($nastavno){
		$this->nastavno = $nastavno;
	}
	
	public function setNapomena($napomena){
		$this->napomena = trim($napomena);
	}
	
	public function findAll(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//traženje terapija određenog kartona
		$izraz = $veza->prepare("select o.ime, o.prezime, o.telefon, o.godiste, l.vrijemeDolaska, l.id, l.nastavno, l.napomena from 
								 kartoni_listaZaZvati l inner join kartoni_osobe o on l.osoba_id=o.id 
								 order by l.tip,l.vrijemeDolaska;");
		$izraz->execute();		
		return $izraz->fetchAll(PDO::FETCH_OBJ);
	}
	
	public function findById(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$id = $this->id;
		
		//traženje terapija određenog kartona
		$izraz = $veza->prepare("select * from kartoni_listaZaZvati where id=:id;");
		$izraz->bindParam(":id", $id);
		$izraz->execute();				
		$stavka = $izraz->fetch(PDO::FETCH_OBJ);
		
		$this->setOsobaId($stavka->osoba_id);
		$this->setVrijeme($stavka->vrijemeDolaska);
		$this->setTip($stavka->tip);
		$this->setNastavno($stavka->nastavno);
		$this->setNapomena($stavka->napomena);
	}
	
	public function insert(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$osoba_id = $this->osoba_id;
		$vrijeme = $this->vrijeme;
		$tip = $this->tip;
		$nastavno = $this->nastavno;
		$napomena = $this->napomena;
		
		$izraz = $veza->prepare("insert into kartoni_listaZaZvati(osoba_id,vrijemeDolaska,tip,nastavno,napomena) 
												  values(:osoba_id,:vrijeme,:tip,:nastavno,:napomena);");
		$izraz->bindParam(":osoba_id", $osoba_id);
		$izraz->bindParam(":vrijeme", $vrijeme);
		$izraz->bindParam(":tip", $tip);
		$izraz->bindParam(":nastavno", $nastavno);
		$izraz->bindParam(":napomena", $napomena);
		$izraz->execute();	
		
		return 'Unešeno';
		
	}
	
	public function update(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$id = $this->id;
		$vrijeme = $this->vrijeme;
		$tip = $this->tip;
		$nastavno = $this->nastavno;
		$napomena = $this->napomena;
		
		$izraz = $veza->prepare("update kartoni_listaZaZvati set vrijemeDolaska=:vrijeme,tip=:tip,nastavno=:nastavno,napomena=:napomena 
								 where id=:id");
		$izraz->bindParam(":vrijeme", $vrijeme);
		$izraz->bindParam(":tip", $tip);
		$izraz->bindParam(":nastavno", $nastavno);
		$izraz->bindParam(":napomena", $napomena);
		$izraz->bindParam(":id", $id);
		$izraz->execute();	
	}
	
	public function brisanjeListe(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		//brisanje cijele liste za zvati
		$izraz = $veza->prepare("truncate kartoni_listaZaZvati;");
		$izraz->execute();	
		
		echo "Lista obrisana";
	}
	
	public function brisanjeUnosa(){
		parent::__construct();
		
		$veza = $this->veza;
		$izraz = $this->izraz;
		
		$id = $this->id;
		
		//brisanje sa liste za zvati
		$izraz = $veza->prepare("delete from kartoni_listaZaZvati where id=:id;");
		$izraz->bindParam(":id", $id);
		$izraz->execute();	
		
		echo "Unos obrisan";
	}
}
