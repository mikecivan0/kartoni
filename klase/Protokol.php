<?php
class Protokol extends SQL{
	
	public $noviBrojevi;
	public $stariBrojevi;
	private $path;
	
	function __construct(){		
		$this->stariBrojevi = '';
		$this->path = '../../klase/Filter.php';
	}
	
	public function setNoviBrojevi($noviBrojevi){
		$this->noviBrojevi = $noviBrojevi;
	}
	
	public function setStariBrojevi($stariBrojevi){
		$this->stariBrojevi = $stariBrojevi;
	}
		
	public function nemaUProtokolu(){
		
		$sadrzaj = file_get_contents($this->path);
		$listaStarihBrojeva = $this->get_string_between($sadrzaj, 'nemaUProtokolu = array(', ');');
		$listaNovihBrojeva = str_replace(",",", ",$listaStarihBrojeva);
		
		$this->setStariBrojevi($listaStarihBrojeva);
		$this->setNoviBrojevi($listaNovihBrojeva);
		
	}

	public function update(){		
		
		$stariBrojevi = 'nemaUProtokolu = array('. $this->stariBrojevi . ');';
		$noviBrojevi = trim($this->noviBrojevi);
		$noviBrojeviTrimZarez = trim($noviBrojevi,",");
		
		$noviBrojeviBezRazmaka = str_replace(array(" ","  ","   "),"",$noviBrojeviTrimZarez);	
		$noviBrojeviCijeliArray = 	'nemaUProtokolu = array('. $noviBrojeviBezRazmaka . ');';
		
		$strFilter = file_get_contents($this->path);		
		$novo = str_replace($stariBrojevi,$noviBrojeviCijeliArray,$strFilter);
			
		$path_file = fopen($this->path, 'w');
		fwrite($path_file, $novo);
		fclose($path_file);

		
	}
	
	private function get_string_between($string, $start, $end){
		$string = ' ' . $string;
		$ini = strpos($string, $start);
		if ($ini == 0) return '';
		$ini += strlen($start);
		$len = strpos($string, $end, $ini) - $ini;
		return substr($string, $ini, $len);
	}

}
